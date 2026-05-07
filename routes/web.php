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


Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard & Profile
    |--------------------------------------------------------------------------
    */

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::view('/profile', 'profile')->name('profile');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', AdminDashboard::class)
                ->name('dashboard');

            // Classes
            Route::get('/manage-classes', ManageClasses::class)
                ->name('manage-classes');

            // Rules
            Route::get('/rules', RuleManager::class)
                ->name('rules');

            // Students
            Route::get('/manage-students', ManageStudents::class)
                ->name('manage-students');

            Route::get('/students', ManageStudents::class)
                ->name('students');

            // Teachers
            Route::get('/teachers', ManageTeachers::class)
                ->name('teachers');

            // Parents
            Route::get('/parents', ManageParents::class)
                ->name('parents');

            /*
            |--------------------------------------------------------------------------
            | VIOLATIONS
            |--------------------------------------------------------------------------
            */

            // Input Pelanggaran
            Route::get('/violations', ViolationManager::class)
                ->name('violations');

            // Verifikasi Pelanggaran
            Route::get('/verify-violations', VerifyViolations::class)
                ->name('verify-violations');
        });

    /*
    |--------------------------------------------------------------------------
    | GURU / PIKET / ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin,guru,piket'])
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {

            // contoh nanti
            // Route::get('/report', TeacherReport::class)
            //     ->name('report');

        });

    /*
    |--------------------------------------------------------------------------
    | PIKET / ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin,piket'])
        ->prefix('piket')
        ->name('piket.')
        ->group(function () {

            // contoh nanti
            // Route::get('/verify', VerifyViolation::class)
            //     ->name('verify');

        });

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:siswa'])
        ->prefix('siswa')
        ->name('siswa.')
        ->group(function () {

            // contoh nanti
            // Route::get('/my-violations', MyViolations::class)
            //     ->name('violations');

        });
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
