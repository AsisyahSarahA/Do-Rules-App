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
use App\Livewire\WaliKelas\RiwayatPelanggaran;
use App\Livewire\WaliKelas\CreateViolation;

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
            Route::get('/violations', ViolationManager::class)->name('violations'); // Rekap Admin
            Route::get('/verify-violations', VerifyViolations::class)->name('verify-violations');
        });

    // | 2. GURU / PIKET (Akses Berdasarkan Tugas)
    Route::middleware(['role:guru,piket'])
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            // Guru biasa diarahkan ke Form Input Laporan Baru
            Route::get('/violations', CreateViolation::class)->name('violations');

            // Hanya Guru Piket yang bisa verifikasi
            Route::get('/verify-violations', VerifyViolations::class)
                ->middleware('role:piket')
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
            // Route::get('/dashboard', KesiswaanDashboard::class)->name('dashboard');
        });

    // | 5. BIMBINGAN KONSELING (BK) ROUTES
    Route::middleware(['role:bk'])
        ->prefix('bk')
        ->name('bk.')
        ->group(function () {
            // Route::get('/dashboard', BkDashboard::class)->name('dashboard');
        });

    // | 6. WALI KELAS ROUTES
    Route::middleware(['role:wali_kelas'])
        ->prefix('walikelas')
        ->name('walikelas.')
        ->group(function () {
            Route::get('/my-class', MyClassViolations::class)->name('my-class');
            Route::get('/sanctions', ManageSanction::class)->name('sanctions');
            // Form Input Laporan Baru khusus Wali Kelas
            Route::get('/violations', CreateViolation::class)->name('violations');
        });

    // | 7. ROUTE BERSAMA (Bisa diakses Wali Kelas & Guru)
    Route::middleware(['role:wali_kelas,guru'])
        ->get('/walikelas/riwayat-pelanggaran', RiwayatPelanggaran::class)
        ->name('walikelas.riwayat-pelanggaran');
});

require __DIR__ . '/auth.php';