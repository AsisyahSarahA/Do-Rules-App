<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use App\Models\WarningLetter;
use App\Models\Counseling;
use App\Models\Sanction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    public function verify($id)
    {
        DB::beginTransaction();

        try {

            $violation = Violation::with(['student', 'rule'])
                ->findOrFail($id);

            // cegah double verify
            if ($violation->status !== 'pending') {

                return response()->json([
                    'message' => 'Pelanggaran sudah diverifikasi'
                ], 400);
            }

            // update status
            $violation->update([
                'status' => 'verified',
                'verified_by' => Auth::id()
            ]);

            // tambah point
            $student = $violation->student;
            $rule = $violation->rule;

            $student->increment('total_points', $rule->point);

            // auto sanction
            $this->handleAutoAction($student);

            DB::commit();

            return response()->json([
                'message' => 'Berhasil diverifikasi'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal verifikasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function handleAutoAction($student)
    {
        $point = $student->total_points;

        $sanction = Sanction::where('min_point', '<=', $point)
            ->where('max_point', '>=', $point)
            ->first();

        if (!$sanction) {
            return;
        }

        // SURAT PERINGATAN
        if (in_array($sanction->action, ['SP1', 'SP2', 'SP3'])) {

            WarningLetter::firstOrCreate([
                'student_id' => $student->id,
                'type' => $sanction->action
            ]);
        }

        // KONSELING
        if ($sanction->action === 'konseling') {

            Counseling::firstOrCreate(
                ['student_id' => $student->id],
                ['notes' => 'Perlu pembinaan']
            );
        }
    }
}