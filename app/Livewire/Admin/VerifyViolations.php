<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class VerifyViolations extends Component
{
    use WithPagination;

    // 1. DEKLARASI PROPERTI MODAL (Ini yang tadinya hilang sehingga bikin error)
    public $isOpenModal = false;
    public $selectedViolation = null;

    /*
    |--------------------------------------------------------------------------
    | DETAIL MODAL CONTROLLER
    |--------------------------------------------------------------------------
    */
    public function openDetailModal($id)
    {
        $this->selectedViolation = Violation::with([
            'student', 'rule', 'reporter'
        ])->findOrFail($id);

        $this->isOpenModal = true;
    }

    public function closeModal()
    {
        $this->isOpenModal = false;
        $this->selectedViolation = null;
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFICATION LOGIC
    |--------------------------------------------------------------------------
    */
    public function verify($id)
    {
        $violation = Violation::findOrFail($id);

        $violation->update([
            'status' => 'diverifikasi',
            'verified_by' => Auth::id() // Menggunakan Facade Auth anti-error
        ]);

        $this->closeModal();
        $this->dispatch('success', message: 'Laporan pelanggaran berhasil diverifikasi!');
    }

    public function reject($id)
    {
        $violation = Violation::findOrFail($id);

        $violation->update([
            'status' => 'ditolak',
            'verified_by' => Auth::id()
        ]);

        $this->closeModal();
        $this->dispatch('success', message: 'Laporan pelanggaran telah ditolak.');
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER ENGINE
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        // Mengambil data pelanggaran yang berstatus 'pending' sesuai query database Anda
        $pendingViolations = Violation::with(['student', 'rule', 'reporter'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.verify-violations', [
            'violations' => $pendingViolations
        ]);
    }
}
