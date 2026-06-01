<?php

namespace App\Livewire\WaliKelas;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Rule;
use App\Enums\ViolationStatus;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class RiwayatPelanggaran extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpenEditModal = false;

    // Properti Form Edit
    public $selectedViolationId;
    public $studentName, $ruleName, $notes;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Fungsi membuka modal edit dengan validasi 24 jam di sisi server
    public function openEditModal($id)
    {
        $violation = Violation::with('student', 'rule')->findOrFail($id);

        // ✅ Menggunakan kolom 'reported_by' sesuai database
        if ($violation->reported_by !== Auth::id()) {
            session()->flash('error', 'Anda tidak memiliki akses mengedit data ini.');
            return;
        }

        if ($violation->created_at->addHours(24)->isPast()) {
            session()->flash('error', 'Batas waktu 24 jam telah habis. Data tidak dapat diubah.');
            return;
        }

        $this->selectedViolationId = $id;
        $this->studentName = $violation->student->name;
        $this->ruleName = $violation->rule->name;
        $this->notes = $violation->notes;
        $this->isOpenEditModal = true;
    }

    public function closeEditModal()
    {
        $this->isOpenEditModal = false;
        $this->reset(['selectedViolationId', 'studentName', 'ruleName', 'notes']);
    }

    // Eksekusi Update Data
    public function updateViolation()
    {
        $violation = Violation::findOrFail($this->selectedViolationId);

        // ✅ Menggunakan kolom 'reported_by' sesuai database
        if ($violation->reported_by === Auth::id() && $violation->created_at->addHours(24)->isFuture()) {
            $violation->update([
                'notes' => $this->notes
            ]);

            $this->closeEditModal();
            session()->flash('message', 'Catatan kronologi pelanggaran berhasil diperbarui!');
        } else {
            $this->closeEditModal();
            session()->flash('error', 'Gagal memperbarui. Batas waktu telah habis atau akses ditolak.');
        }
    }

    public function render()
    {
        // ✅ Menggunakan kolom 'reported_by' untuk memfilter laporan milik guru yang login
        $query = Violation::with(['student.classroom', 'rule'])
            ->where('reported_by', Auth::id());

        if ($this->search) {
            $query->whereHas('student', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.walikelas.riwayat-pelanggaran', [
            'violations' => $query->latest()->paginate(10)
        ]);
    }
}
