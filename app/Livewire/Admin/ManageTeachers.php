<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ManageTeachers extends Component
{
    public $name, $nip, $teacherId;
    public $isEdit = false;
    public $showForm = false;
    public $search = '';

    // ================= SAVE =================
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'nip' => 'required|unique:teachers,nip,' . $this->teacherId
        ]);

        Teacher::updateOrCreate(
            ['id' => $this->teacherId],
            [
                'name' => $this->name,
                'nip' => $this->nip
            ]
        );

        session()->flash('message', 'Data guru berhasil disimpan');

        $this->resetForm();
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        $this->teacherId = $teacher->id;
        $this->name = $teacher->name;
        $this->nip = $teacher->nip;

        $this->isEdit = true;
        $this->showForm = true;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        Teacher::findOrFail($id)->delete();

        session()->flash('message', 'Data guru dihapus');
    }

    // ================= RESET =================
    public function resetForm()
    {
        $this->reset(['name', 'nip', 'teacherId']);
        $this->isEdit = false;
        $this->showForm = false;
    }

    // ================= RENDER =================
    public function render()
    {
        $teachers = Teacher::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('nip', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->get();

        return view('livewire.admin.manage-teachers', [
            'teachers' => $teachers
        ]);
    }
}