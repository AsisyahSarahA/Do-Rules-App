<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use App\Models\User;

class ExpiredViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::first();
        $rule = Rule::first();
        $user = User::first();

        if (!$student || !$rule || !$user) {
            return;
        }

        // Violation created 2 days ago (Expired)
        Violation::create([
            'student_id' => $student->id,
            'rule_id' => $rule->id,
            'reported_by' => $user->id,
            'notes' => 'Ini adalah contoh pelanggaran lama yang sudah lewat 24 jam (tidak bisa diedit).',
            'status' => 'pending',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

        // Another one created 5 hours ago (Still editable)
        Violation::create([
            'student_id' => $student->id,
            'rule_id' => $rule->id,
            'reported_by' => $user->id,
            'notes' => 'Ini adalah contoh pelanggaran baru yang masih bisa diedit.',
            'status' => 'pending',
            'created_at' => now()->subHours(5),
            'updated_at' => now()->subHours(5),
        ]);
    }
}
