<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sanction;

class SanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sanction::insert([
            ['min_point' => 0, 'max_point' => 29, 'action' => 'aman'],
            ['min_point' => 30, 'max_point' => 49, 'action' => 'konseling'],
            ['min_point' => 50, 'max_point' => 74, 'action' => 'SP1'],
            ['min_point' => 75, 'max_point' => 99, 'action' => 'SP2'],
            ['min_point' => 100, 'max_point' => 999, 'action' => 'SP3'],
        ]);

    }
}
