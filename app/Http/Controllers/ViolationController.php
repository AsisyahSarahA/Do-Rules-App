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
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'rule_id' => 'required|exists:rules,id',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {

            $violation = Violation::create([
                'student_id' => $request->student_id,
                'rule_id' => $request->rule_id,
                'reported_by' => Auth::id(),
                'notes' => $request->notes,
                'status' => 'pending'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Pelanggaran berhasil dilaporkan',
                'data' => $violation
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