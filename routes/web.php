<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\ManageClasses;
use App\Livewire\Admin\ManageTeachers;
use App\Livewire\Admin\ManageStudents;
use App\Livewire\Admin\ManageParents;
use App\Livewire\Admin\RuleManager;
use App\Livewire\Admin\VerifyViolations;
use App\Livewire\Admin\ViolationManager;
use App\Livewire\Admin\ManageDutySchedules;
use App\Livewire\WaliKelas\MyClassViolations;
use App\Livewire\Teacher\ManageSanction;


Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    // | Dashboard & Profile Umum
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');

    // | 1. ADMIN ROUTES
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
            Route::get('/manage-classes', ManageClasses::class)->name('manage-classes');
            Route::get('/manage-schedules', ManageDutySchedules::class)->name('manage-schedules');
            Route::get('/rules', RuleManager::class)->name('rules');
            Route::get('/manage-students', ManageStudents::class)->name('manage-students');
            Route::get('/students', ManageStudents::class)->name('students');
            Route::get('/teachers', ManageTeachers::class)->name('teachers');
            Route::get('/parents', ManageParents::class)->name('parents');
            Route::get('/my-class', MyClassViolations::class)->name('my-class');

            // Khusus Admin langsung ke halaman admin
            Route::get('/violations', ViolationManager::class)->name('violations');
            Route::get('/verify-violations', VerifyViolations::class)->name('verify-violations');
        });

    // | 2. GURU / PIKET / ADMIN (Akses Berdasarkan Tugas)
    Route::middleware(['role:admin,guru,piket'])
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            // Semua guru bisa input pelanggaran
            Route::get('/violations', ViolationManager::class)->name('violations');

            // Hanya Admin atau Guru yang HARI INI PIKET yang bisa lolos ke halaman verifikasi ini
            Route::get('/verify-violations', VerifyViolations::class)
                ->middleware('role:admin,piket')
                ->name('verify-violations');
        });

    // | 3. SISWA
    Route::middleware(['role:siswa'])
        ->prefix('siswa')
        ->name('siswa.')
        ->group(function () {
            // Route::get('/my-violations', MyViolations::class)->name('violations');
        });


    // | 4. KESISWAAN ROUTES
    Route::middleware(['role:kesiswaan'])
        ->prefix('kesiswaan')
        ->name('kesiswaan.')
        ->group(function () {
            // Halaman dashboard kesiswaan untuk melihat & menangani kasus 'sedang'
            // Route::get('/dashboard', KesiswaanDashboard::class)->name('dashboard');
        });

    // | 5. BIMBINGAN KONSELING (BK) ROUTES
    Route::middleware(['role:bk'])
        ->prefix('bk')
        ->name('bk.')
        ->group(function () {
            // Halaman BK untuk melihat kasus berat & cetak Surat Peringatan (SP)
            // Route::get('/dashboard', BkDashboard::class)->name('dashboard');
        });

    // | 6. WALI KELAS ROUTES
    Route::middleware(['role:wali_kelas'])
        ->prefix('walikelas')
        ->name('walikelas.')
        ->group(function () {
            // Halaman Wali Kelas untuk memantau grafik poin khusus kelasnya sendiri
            Route::get('/my-class', MyClassViolations::class)->name('my-class');
            Route::get('/violations', ViolationManager::class)->name('violations');
            Route::get('/sanctions', ManageSanction::class)->name('sanctions');
        });
});

require __DIR__ . '/auth.php';
