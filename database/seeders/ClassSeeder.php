<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        ClassRoom::create([
            'id' => 1,
            'name' => 'X RPL 1',
            'wali_kelas_id' => 3,
            'school_year' => 2026
        ]);

        ClassRoom::create([
            'id' => 2,
            'name' => 'X PPLG 2',
            'wali_kelas_id' => 5,
            'school_year' => 2027
        ]);
    }
}
