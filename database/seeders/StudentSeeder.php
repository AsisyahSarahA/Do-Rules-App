<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\ParentModel;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data parent yang sudah ada
        $parent1 = ParentModel::find(1);
        $parent2 = ParentModel::find(2);

        Student::create([
            'name' => 'Budi',
            'nis' => '12345',
            'class_id' => 1,
            'parent_id' => $parent1?->id,
            'total_points' => 0
        ]);

        Student::create([
            'name' => 'Siti',
            'nis' => '12346',
            'class_id' => 1,
            'parent_id' => $parent2?->id,
            'total_points' => 0
        ]);
    }
}