<?php

namespace App\Livewire\WaliKelas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Violation;

class MyClassViolations extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Ambil data kelas yang dipimpin oleh guru ini
        $classroom = $user->classroom;

        // Proteksi jika diakses oleh user yang bukan wali kelas mana pun
        if (!$classroom) {
            abort(403, 'Anda tidak terdaftar sebagai Wali Kelas di kelas manapun.');
        }

        // 2. PERBAIKAN: Hubungkan tabel violations dengan rules agar bisa menghitung 'rules.point'
        $students = Student::where('class_id', $classroom->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->withCount(['violations as total_points' => function ($query) {
                $query->join('rules', 'violations.rule_id', '=', 'rules.id') // <--- KUNCI PERBAIKAN
                      ->select(DB::raw('sum(rules.point)'));
            }])
            ->paginate(10);

        // 3. Ambil 5 riwayat pelanggaran terbaru + panggil relasi 'rule' agar namanya bisa muncul di blade
        $recentViolations = Violation::whereHas('student', function ($query) use ($classroom) {
            $query->where('class_id', $classroom->id);
        })
        ->with(['student', 'rule']) // <--- Menambahkan 'rule' agar terbaca di halaman aktivitas
        ->latest()
        ->take(5)
        ->get();

        return view('livewire.wali-kelas.my-class-violations', [
            'classroom'        => $classroom,
            'students'         => $students,
            'recentViolations' => $recentViolations
        ]);
    }
}
