<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@guru.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@guru.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ],
            [
                'name' => 'Ahmad Hidayat',
                'email' => 'ahmad@guru.com',
                'password' => Hash::make('password'),
                'role' => 'wali_kelas',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@guru.com',
                'password' => Hash::make('password'),
                'role' => 'wali_kelas',
            ],
            [
                'name' => 'Rizky Pratama',
                'email' => 'rizky@guru.com',
                'password' => Hash::make('password'),
                'role' => 'piket',
            ],
        ]);
    }
}
