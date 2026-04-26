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
            'name' => 'X RPL 1',
            'wali_kelas_id' => 2,
            'school_year' => 2026
        ]);
    }
}
