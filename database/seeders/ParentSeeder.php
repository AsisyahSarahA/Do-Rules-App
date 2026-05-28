<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParentModel;
use App\Models\Student;

class ParentSeeder extends Seeder
{
    public function run(): void
    {
        $student1 = Student::first();
        $student2 = Student::skip(1)->first();

        ParentModel::create([
            'name' => 'Edy Diana',
            'phone' => '08123456789',
            'address' => 'Ciamis',
        ]);

        ParentModel::create([
            'name' => 'Siti Maspiroh',
            'phone' => '08987654321',
            'address' => 'Sumedang',
        ]);
    }
}
