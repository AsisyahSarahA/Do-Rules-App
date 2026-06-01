<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Rule;
use App\Models\Sanction; // 👈 Daftarkan model Sanction
use App\Enums\ViolationStatus;
use App\Enums\SanctionStatus;   // 👈 Daftarkan enum SanctionStatus kamu
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class VerifyViolations extends Component
{
    use WithPagination;

    public $isOpenModal = false;
    public ?int $selectedViolationId = null;

    // Search & Filters
    public $search = '';
    public $filterLevel = '';
    public $filterStatus = 'pending'; 
    public $filterRule = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterLevel() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }
    public function updatingFilterRule() { $this->resetPage(); }

    #[Computed]
    public function selectedViolation()
    {
        if (!$this->selectedViolationId) return null;

        return Violation::with(['student.classroom', 'rule', 'reporter', 'verifier'])
            ->find($this->selectedViolationId);
    }

    public function openDetailModal($id)
    {
        $this->selectedViolationId = $id;
        $this->isOpenModal = true;
    }

    public function closeModal()
    {
        $this->isOpenModal = false;
        $this->selectedViolationId = null;
    }

    public function verify($id)
    {
        try {
            // Ambil data pelanggaran beserta aturan (rule) di dalamnya
            $violation = Violation::with('rule')->findOrFail($id);

            // 1. Update status pelanggaran di tabel 'violations'
            $violation->update([
                'status' => ViolationStatus::VERIFIED, 
                'verified_by' => Auth::id(),
                'verified_at' => now()
            ]);

            // 2. 🔥 JEMBATAN OTOMATIS: Membuat data sanksi baru untuk Wali Kelas
            Sanction::create([
                'violation_id' => $violation->id,
                'status'       => SanctionStatus::PENDING, // 👈 Menggunakan Enum SanctionStatus kamu ('pending')
                'action'       => 'Menjalani sanksi akibat melanggar aturan: ' . ($violation->rule->name ?? 'Tata Tertib'), 
                'notes'        => 'Menunggu tindak lanjut dan unggah bukti dari Wali Kelas.',
            ]);

            $this->closeModal();
            session()->flash('message', 'Laporan pelanggaran berhasil diverifikasi & sanksi otomatis diteruskan ke Wali Kelas!');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Gagal Verifikasi: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $violation = Violation::findOrFail($id);

            // Langsung menggunakan Enum baru yang berbahasa Indonesia
            $violation->update([
                'status' => ViolationStatus::REJECTED, 
                'verified_by' => Auth::id(),
                'verified_at' => now()
            ]);

            $this->closeModal();
            session()->flash('message', 'Laporan pelanggaran telah ditolak.');
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Gagal Menolak: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Violation::with(['student.classroom', 'rule', 'reporter', 'verifier']);

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->whereHas('student', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterLevel) {
            $query->whereHas('rule', function ($q) {
                $q->where('level', $this->filterLevel);
            });
        }

        if ($this->filterRule) {
            $query->where('rule_id', $this->filterRule);
        }

        return view('livewire.admin.verify-violations', [
            'violations' => $query->latest()->paginate(10),
            'rules' => Rule::orderBy('name', 'asc')->get()
        ]);
    }
}