<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        Student::create([
            // 'user_id' => 2,
            'name' => 'Budi',
            'nis' => '12345',
            'class_id' => 1,
            'total_points' => 0
        ]);
    }
}
