<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViolationController extends Controller
{
    public function index()
    {
        return view('violations.index');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'rule_id' => 'required|exists:rules,id',
        ]);

        // 2. AMBIL DATA
        $rule = Rule::findOrFail($request->rule_id);
        $student = Student::findOrFail($request->student_id);

        // 3. TRANSACTION (PENTING)
        DB::beginTransaction();

        try {
            // simpan pelanggaran
            $violation = Violation::create([
                'student_id' => $student->id,
                'rule_id' => $rule->id,
                'reported_by' => Auth::id(),
                'status' => 'pending'
            ]);

            // tambah point
            $student->increment('total_points', $rule->point);

            // tentukan handler
            $handler = match ($rule->level) {
                'ringan' => 'wali_kelas',
                'sedang' => 'kesiswaan',
                default => 'bk'
            };

            DB::commit();

            return response()->json([
                'message' => 'Pelanggaran berhasil dicatat',
                'handled_by' => $handler
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
