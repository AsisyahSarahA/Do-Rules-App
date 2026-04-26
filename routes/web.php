<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManageRules; // Contoh untuk Master Peraturan nanti
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManageClasses;
use App\Livewire\Admin\VerifyViolations;
use App\Livewire\Admin\ManageTeachers;
use App\Livewire\Admin\ManageStudents;
/*
| Public Routes
*/

Route::view('/', 'welcome');

/*
| Authenticated Routes (Semua yang sudah Login)
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama (Bisa diarahkan sesuai role nanti)
    // Route::view('dashboard', 'dashboard')->name('dashboard');

    // Profile Settings
    Route::view('profile', 'profile')->name('profile');

    /*
    | Admin Only Routes
    */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/manage-classes', ManageClasses::class)->name('manage-classes');
        Route::get('/rules', \App\Livewire\Admin\RuleManager::class)->name('rules');
        Route::get('/manage-students', ManageStudents::class)->name('manage-students');



        Route::get('/teachers', ManageTeachers::class)->name('teachers');


        Route::get('/verify-violations', VerifyViolations::class)->name('verify-violations');
    });

    /*
    | Guru / Piket / Admin Routes (Lapor Pelanggaran)
    */
    Route::middleware(['role:admin,guru,piket'])->prefix('teacher')->name('teacher.')->group(function () {
        // Route::get('/report', TeacherReport::class)->name('report');
    });

    /*
    | Piket / Admin Routes (Verifikasi)
    */
    Route::middleware(['role:admin,piket'])->prefix('piket')->name('piket.')->group(function () {
        // Route::get('/verify', VerifyViolation::class)->name('verify');
    });

    /*
    | Siswa Routes
    */
    Route::middleware(['role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        // Route::get('/my-violations', MyViolations::class)->name('violations');
    });
});

require __DIR__ . '/auth.php';
