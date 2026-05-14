<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Livewire\WithPagination;
use Livewire\Attributes\On;

#[Layout('layouts.app')]

class ViolationManager extends Component
{
    use WithFileUploads, WithPagination;

    // FORM
    public $showForm = false;

    public $student_id;
    public $rule_id;
    public $notes;
    public $evidence;
    public $violationId;
    public $isEdit = false;

    // SEARCH & FILTERS
    public $search = '';
    public $filterDay;
    public $filterWeek;
    public $filterMonth;
    public $filterYear;

    // DETAIL MODAL
    public $selectedViolation = null;
    public $showDetailModal = false;

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

    public function updatedSearch()
    {
        $this->resetPage();
    }

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
    | SAVE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $violation = Violation::findOrFail($id);

        if ($violation->created_at->diffInHours(now()) >= 24) {
            $this->dispatch('error', message: 'Data tidak dapat diedit setelah 24 jam.');
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
                'reported_by' => auth()->id(),
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
            'student_id',
            'rule_id',
            'notes',
            'evidence',
            'violationId',
            'isEdit',
            'showForm'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function showDetail($id)
    {
        $this->selectedViolation = Violation::with([
            'student',
            'rule',
            'reporter',
            'verifier'
        ])->findOrFail($id);

        $this->showDetailModal = true;
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedViolation = null;
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
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
    | RENDER
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $students = Student::orderBy('name')->get();

        $rules = Rule::orderBy('name')->get();

        $violations = Violation::with([
            'student',
            'rule',
            'reporter',
            'verifier'
        ])
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where(
                        'name',
                        'like',
                        '%' . $this->search . '%'
                    );
                });
            })
            ->when($this->filterDay, function ($query) {
                $query->whereDate('created_at', $this->filterDay);
            })
            ->when($this->filterWeek, function ($query) {
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::parse($this->filterWeek)->startOfWeek(),
                    \Carbon\Carbon::parse($this->filterWeek)->endOfWeek()
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

        return view(
            'livewire.admin.violation-manager',
            [
                'students' => $students,
                'rules' => $rules,
                'violations' => $violations
            ]
        );
    }
}