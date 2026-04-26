<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        Rule::create([
            'name' => 'Tidak pakai seragam',
            'description' => 'Melanggar aturan sekolah',
            'point' => 10,
            'level' => 'ringan'
        ]);

        Rule::create([
            'name' => 'Bolos',
            'description' => 'Tidak masuk tanpa izin',
            'point' => 50,
            'level' => 'berat'
        ]);
    }
}
