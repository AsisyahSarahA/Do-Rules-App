<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachersData = [
            [
                // 'id' => 2,
                'name' => 'Cecep Riki',
                'email' => 'ceri@mail.com',
                'nip' => 198501012010011001,
                'role' => 'guru',
            ],
            [
                // 'id' => 4,
                'name' => 'Nabila Azzahra',
                'email' => 'nabila@mail.com',
                'nip' => 198903152015022002,
                'role' => 'piket',
            ],
            [
                // 'id' => 3,
                'name' => 'Muhammad Aripin',
                'email' => 'aripin@mail.com',
                'nip' => 199208042019032004,
                'role' => 'wali_kelas',
            ],
            [
                // 'id' => 5,
                'name' => 'Pratiwi Agustin',
                'email' => 'pratiwi@mail.com',
                'nip' => 1234567890,
                'role' => 'wali_kelas',
            ],

        ];

        foreach ($teachersData as $data) {
            // 1. Buat User Login
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => $data['role'],
            ]);

            // 2. Buat Detail Teacher terkait user tersebut
            Teacher::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'nip' => $data['nip'],
                'email' => $data['email'],
                'phone' => '08123456789',
                'status' => 'aktif'
            ]);
        }
    }
}
 