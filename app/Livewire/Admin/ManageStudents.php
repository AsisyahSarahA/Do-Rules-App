<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\ParentModel;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class ManageStudents extends Component
{
    public $name, $nis, $class_room_id, $parent_id, $studentId;
    public $search = '';
    public $isEdit = false;
    public $showForm = false;

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'nis' => 'required|unique:students,nis,' . $this->studentId,
            'class_room_id' => 'required',
        ]);

        Student::updateOrCreate(
            ['id' => $this->studentId],
            [
                'name' => $this->name,
                'nis' => $this->nis,
                'class_room_id' => $this->class_room_id,
                'parent_id' => $this->parent_id,
            ]
        );

        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $this->studentId = $student->id;
        $this->name = $student->name;
        $this->nis = $student->nis;
        $this->class_room_id = $student->class_room_id;
        $this->parent_id = $student->parent_id;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        Student::find($id)?->delete();
    }

    public function resetForm()
    {
        $this->reset(['name', 'nis', 'class_room_id', 'parent_id', 'studentId']);
        $this->isEdit = false;
    }

    public function render()
    {
        $students = Student::with(['classRoom', 'parent'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();

        $classes = ClassRoom::all();
        $parents = ParentModel::all();

        return view('livewire.admin.manage-students', [
            'students' => $students,
            'classes' => $classes,
            'parents' => $parents
        ]);
    }
}