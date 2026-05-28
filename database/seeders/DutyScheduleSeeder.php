<?php

namespace Database\Seeders;

use App\Models\DutySchedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DutyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat user guru piket
        $guruPiket = User::firstOrCreate(
            ['email' => 'gurupiket@sekolah.sch.id'],
            [
                'name' => 'Guru Piket Hari Ini',
                'password' => Hash::make('password'), // password default
                'role' => 'guru',
            ]
        );

        // 2. Beri jadwal piket untuk hari ini
        DutySchedule::firstOrCreate(
            [
                'user_id' => $guruPiket->id,
                'duty_date' => date('Y-m-d')
            ]
        );
    }
}
