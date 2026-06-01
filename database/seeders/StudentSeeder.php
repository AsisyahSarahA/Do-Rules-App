<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data parent yang sudah ada
        $parent1 = ParentModel::find(1);
        $parent2 = ParentModel::find(2);

        // --- SISWA 1 ---
        // 1. Buat User untuk Echa
        $user1 = User::create([
            'name' => 'Echa Muhammad Roffy Yandi',
            'email' => 'echa@siswa.com', // Akun login Echa
            'password' => Hash::make('202402020'), // Password sesuai NIS
            // 'class_id' => 1, // Set class_id langsung
            'role' => 'siswa' // <-- Tambahkan ini
        ]);

        // 2. Buat Data Siswa Echa
        Student::create([
            'user_id' => $user1->id,
            'name' => 'Echa Muhammad Roffy Yandi',
            'nis' => '202402020',
            'class_id' => 1,
            'parent_id' => $parent1?->id,
            'total_points' => 0
        ]);


        // --- SISWA 2 ---
        // 1. Buat User untuk Ikhsan
        $user2 = User::create([
            'name' => 'M Ikhsan Hidayat',
            'email' => 'ikhsan@siswa.com', // Akun login Ikhsan
            'password' => Hash::make('202402021'), // Password sesuai NIS
            'role' => 'siswa'// <-- Tambahkan ini
        ]);

        // 2. Buat Data Siswa Ikhsan
        Student::create([
            'user_id' => $user2->id,
            'name' => 'M Ikhsan Hidayat',
            'nis' => '202402021',
            'class_id' => 2,
            'parent_id' => $parent2?->id,
            'total_points' => 0
        ]);
        // --- SISWA 3 ---
        // 1. Buat User untuk Ikhsan
        $user3 = User::create([
            'name' => 'Lashira Adzkia rasyid',
            'email' => 'lashira@mail.com', // Akun login Lashira
            'password' => Hash::make('202402022'), // Password sesuai NIS
            'role' => 'siswa'// <-- Tambahkan ini
        ]);

        // 2. Buat Data Siswa Ikhsan
        Student::create([
            'user_id' => $user3->id,
            'name' => 'Lashira Adzkia rasyid',
            'nis' => '202402022',
            'class_id' => 2,
            'parent_id' => $parent2?->id,
            'total_points' => 0
        ]);
    }
}
