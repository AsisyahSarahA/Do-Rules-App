<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <-- Import Facade Auth Resmi
use Carbon\Carbon;

#[Layout('layouts.app')]
class ViolationManager extends Component
{
    use WithFileUploads, WithPagination;

    // FORM PROPERTIES
    public $showForm = false;
    public $student_id;
    public $rule_id;
    public $notes;
    public $evidence;
    public $violationId;
    public $isEdit = false;

    // SEARCH & ADVANCED FILTERS
    public $search = '';
    public $filterLevel = '';
    public $filterStatus = '';
    public $filterRule = '';

    // DATE FILTERS
    public $filterDay;
    public $filterWeek;
    public $filterMonth;
    public $filterYear;

    // DETAIL MODAL PROPERTIES
    public $selectedViolation = null;
    public $isOpenModal = false;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'rule_id' => 'required|exists:rules,id',
        'notes' => 'nullable|string|max:1000',
        'evidence' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'student_id.required' => 'Siswa wajib dipilih',
        'rule_id.required' => 'Peraturan wajib dipilih',
        'evidence.image' => 'File harus berupa gambar',
        'evidence.max' => 'Ukuran gambar maksimal 2MB',
    ];

    // RESET PAGINATION ON FILTER CHANGED
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterLevel() { $this->resetPage(); }
    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterRule() { $this->resetPage(); }
    public function updatedFilterDay() { $this->resetPage(); }
    public function updatedFilterWeek() { $this->resetPage(); }
    public function updatedFilterMonth() { $this->resetPage(); }
    public function updatedFilterYear() { $this->resetPage(); }

    public function updatedEvidence()
    {
        try {
            $this->validateOnly('evidence');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', message: $e->getMessage());
            $this->reset('evidence');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE & EDIT LOGIC (WITH 24-HOUR LOCK)
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $violation = Violation::findOrFail($id);

        // PROTEKSI 24 JAM (Hanya bisa dihapus jika lewat 24 jam)
        if ($violation->created_at->diffInHours(now()) >= 24) {
            $this->dispatch('error', message: '🔒 Batas waktu edit (24 jam) sudah lewat. Data hanya bisa dihapus.');
            return;
        }

        $this->violationId = $id;
        $this->student_id = $violation->student_id;
        $this->rule_id = $violation->rule_id;
        $this->notes = $violation->notes;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {
            $violation = Violation::findOrFail($this->violationId);

            if ($violation->created_at->diffInHours(now()) >= 24) {
                $this->dispatch('error', message: 'Gagal update! Batas waktu 24 jam telah terlewati.');
                $this->resetForm();
                return;
            }

            $evidencePath = $violation->evidence;

            if ($this->evidence) {
                if ($violation->evidence) {
                    Storage::disk('public')->delete($violation->evidence);
                }
                $evidencePath = $this->evidence->store('violations', 'public');
            }

            $violation->update([
                'student_id' => $this->student_id,
                'rule_id' => $this->rule_id,
                'notes' => $this->notes,
                'evidence' => $evidencePath,
            ]);

            $this->dispatch('success', message: 'Laporan pelanggaran berhasil diperbarui!');
        } else {
            $evidencePath = null;

            if ($this->evidence) {
                $evidencePath = $this->evidence->store('violations', 'public');
            }

            Violation::create([
                'student_id' => $this->student_id,
                'rule_id' => $this->rule_id,
                'reported_by' => Auth::id(), // <-- Diubah menggunakan Facade Auth statis
                'notes' => $this->notes,
                'evidence' => $evidencePath,
                'status' => 'pending',
            ]);

            $this->dispatch('success', message: 'Laporan pelanggaran berhasil ditambahkan!');
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'student_id', 'rule_id', 'notes', 'evidence', 'violationId', 'isEdit', 'showForm'
        ]);
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
            'verified_by' => Auth::id() // <-- Diubah menggunakan Facade Auth statis
        ]);

        $this->closeModal();
        $this->dispatch('success', message: 'Laporan pelanggaran berhasil diverifikasi!');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL MODAL CONTROLLER
    |--------------------------------------------------------------------------
    */

    public function openDetailModal($id)
    {
        $this->selectedViolation = Violation::with([
            'student', 'rule', 'reporter', 'verifier'
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
    | DELETE LOGIC
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        $violation = Violation::findOrFail($id);
        if ($violation->evidence) {
            Storage::disk('public')->delete($violation->evidence);
        }
        $violation->delete();
        $this->dispatch('success', message: 'Data pelanggaran berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER ENGINE
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $rules = Rule::orderBy('name')->get();

        $violations = Violation::with(['student', 'rule', 'reporter', 'verifier'])
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nis', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterLevel, function ($query) {
                $query->whereHas('rule', function ($q) {
                    $q->where('level', $this->filterLevel);
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterRule, function ($query) {
                $query->where('rule_id', $this->filterRule);
            })
            ->when($this->filterDay, function ($query) {
                $query->whereDate('created_at', $this->filterDay);
            })
            ->when($this->filterWeek, function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::parse($this->filterWeek)->startOfWeek(),
                    Carbon::parse($this->filterWeek)->endOfWeek()
                ]);
            })
            ->when($this->filterMonth, function ($query) {
                $query->whereMonth('created_at', $this->filterMonth);
            })
            ->when($this->filterYear, function ($query) {
                $query->whereYear('created_at', $this->filterYear);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.violation-manager', [
            'students'   => $students,
            'rules'      => $rules,
            'violations' => $violations
        ]);
    }
}
