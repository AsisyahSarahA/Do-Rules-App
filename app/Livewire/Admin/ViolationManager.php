<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]

class ViolationManager extends Component
{
    use WithFileUploads;

    // FORM
    public $showForm = false;

    public $student_id;
    public $rule_id;
    public $notes;
    public $evidence;

    // SEARCH
    public $search = '';

    // DETAIL MODAL
    public $selectedViolation = null;

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

    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

    public function save()
    {
        $this->validate();

        $evidencePath = null;

        if ($this->evidence) {

            $evidencePath = $this->evidence->store(
                'violations',
                'public'
            );
        }

        Violation::create([
            'student_id' => $this->student_id,
            'rule_id' => $this->rule_id,
            'reported_by' => auth()->id(),
            'notes' => $this->notes,
            'evidence' => $evidencePath,
            'status' => 'pending',
        ]);

        session()->flash(
            'message',
            'Pelanggaran berhasil ditambahkan'
        );

        $this->reset([
            'student_id',
            'rule_id',
            'notes',
            'evidence'
        ]);

        $this->showForm = false;
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
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $violation = Violation::findOrFail($id);

        if ($violation->evidence) {

            Storage::disk('public')
                ->delete($violation->evidence);
        }

        $violation->delete();

        session()->flash(
            'message',
            'Data berhasil dihapus'
        );
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
            ->latest()
            ->get();

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