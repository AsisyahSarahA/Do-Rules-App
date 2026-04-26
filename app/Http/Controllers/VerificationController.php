<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $violation = Violation::with(['student', 'rule'])->findOrFail($id);

            // 1. update status
            $violation->update([
                'status' => 'verified',
                'verified_by' => Auth::id()
            ]);

            // 2. tambah point
            $student = $violation->student;
            $rule = $violation->rule;

            $student->increment('total_points', $rule->point);

            // 3. auto action berdasarkan sanction
            $this->handleAutoAction($student);

            DB::commit();

            return response()->json([
                'message' => 'Pelanggaran diverifikasi',
                'points_added' => $rule->point,
                'total_points' => $student->total_points
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal verifikasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * AUTO SYSTEM (SANCTION ENGINE)
     */
    private function handleAutoAction($student)
    {
        $point = $student->total_points;

        $sanction = Sanction::where('min_point', '<=', $point)
            ->where('max_point', '>=', $point)
            ->first();

        if (!$sanction) return;

        // 🔴 SURAT PERINGATAN
        if (in_array($sanction->action, ['SP1', 'SP2', 'SP3'])) {
            WarningLetter::firstOrCreate([
                'student_id' => $student->id,
                'type' => $sanction->action
            ]);
        }

        // 🟡 KONSELING
        if ($sanction->action === 'konseling') {
            Counseling::firstOrCreate(
                ['student_id' => $student->id],
                ['notes' => 'Perlu pembinaan']
            );
        }
    }
}