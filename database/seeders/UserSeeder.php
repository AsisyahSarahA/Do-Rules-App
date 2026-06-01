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
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // User::create([
        //     'id' => 2,
        //     'name' => 'Cecep Riki',
        //     'email' => 'ceri@mail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'guru'
        // ]);
        // User::create([
        //     'id' => 3,
        //     'name' => 'Muhammad Aripin',
        //     'email' => 'aripin@mail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'wali_kelas'
        // ]);
        // User::create([
        //     'id' => 4,
        //     'name' => 'Nabila Azzahra',
        //     'email' => 'nabila@mail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'piket'
        // ]);
        // User::create([
        //     'id' => 5,
        //     'name' => 'Pratiwi Agustin',
        //     'email' => 'pratiwi@mail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'wali_kelas'
        // ]);
    }
}
