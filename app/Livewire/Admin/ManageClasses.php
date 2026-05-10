<?php

namespace App\Livewire\Admin;

use App\Models\ClassRoom;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Student;
use Livewire\Attributes\On;

#[Layout('layouts.app')] // lebih konsisten

class ManageClasses extends Component
{
    use WithPagination;

    public $name, $wali_kelas_id, $school_year, $selected_id;
    public $showForm = false;
    public $isEdit = false;
    public $search = '';
    public $selected_class_id;
    public $students = [];

    protected $paginationTheme = 'tailwind';

    // 🔥 RESET PAGINATION SAAT SEARCH
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // ✅ SAVE / UPDATE
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'school_year' => 'required',
        ]);

        ClassRoom::updateOrCreate(
            ['id' => $this->selected_id], // ✅ FIX
            [
                'name' => $this->name,
                'wali_kelas_id' => $this->wali_kelas_id,
                'school_year' => $this->school_year,
            ]
        );

        $this->dispatch('success', message: 'Data kelas berhasil disimpan!');

        $this->resetForm();
        $this->showForm = false;
    }

    // ✅ EDIT
    public function edit($id)
    {
        $class = ClassRoom::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $class->name;
        $this->wali_kelas_id = $class->wali_kelas_id;
        $this->school_year = $class->school_year;

        $this->isEdit = true;
        $this->showForm = true;
    }

    // ✅ DELETE
    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        ClassRoom::find($id)?->delete();
        $this->dispatch('success', message: 'Data kelas berhasil dihapus!');
    }

    // ✅ RESET FORM
    public function resetForm()
    {
        $this->reset(['name', 'wali_kelas_id', 'school_year', 'selected_id']);
        $this->isEdit = false;
    }

    // ✅ RENDER
    public function render()
    {
        $classes = ClassRoom::with('wali_kelas')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        $teachers = User::where('role', 'wali_kelas')->get();
        // atau Teacher::all() kalau pakai tabel teachers

        return view('livewire.admin.manage-classes', [
            'classes' => $classes,
            'teachers' => $teachers
        ]);
    }

    public function updatedSelectedClassId($value)
    {
        $this->students = Student::where('class_id', $value)->get();
    }
}
