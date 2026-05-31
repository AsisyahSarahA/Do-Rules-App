<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::create([
        'name' => 'Admin',
        'email' => 'admin@mail.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);

    User::create([
        'name' => 'Guru 1',
        'email' => 'guru@mail.com',
        'password' => Hash::make('password'),
        'role' => 'guru'
    ]);
    User::create([
        'name' => 'Wali Kelas 1',
        'email' => 'wakel@mail.com',
        'password' => Hash::make('password'),
        'role' => 'wali_kelas'
    ]);
    }
}
