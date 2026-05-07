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
            'name' => 'Bapak Budi',
            'phone' => '08123456789',
            'address' => 'Tasikmalaya',
        ]);

        ParentModel::create([
            'name' => 'Ibu Siti',
            'phone' => '08987654321',
            'address' => 'Bandung',
        ]);
    }
}