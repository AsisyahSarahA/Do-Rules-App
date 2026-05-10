<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ParentModel;
use App\Models\Student;
use Livewire\Attributes\Layout;

use Livewire\WithPagination;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class ManageParents extends Component
{
    use WithPagination;

    public $name, $phone, $address, $email, $student_id, $parentId;
    public $isEdit = false;
    public $search = '';
    public $showForm = false; // ✅ FIX DISI

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'student_id' => 'required'
        ]);

        ParentModel::updateOrCreate(
            ['id' => $this->parentId],
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
                'email' => $this->email,
                'student_id' => $this->student_id
            ]
        );

        $this->dispatch('success', message: 'Data orang tua berhasil disimpan!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);

        $this->parentId = $parent->id;
        $this->name = $parent->name;
        $this->phone = $parent->phone;
        $this->email = $parent->email;
        $this->address = $parent->address;
        $this->student_id = $parent->student_id;

        $this->isEdit = true;
    }

    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        ParentModel::find($id)?->delete();
        $this->dispatch('success', message: 'Data orang tua berhasil dihapus!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'phone', 'address', 'email', 'student_id', 'parentId']);
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.manage-parents', [
            'parents' => ParentModel::with('students')
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),


            'students' => Student::all()
        ]);
    }
}
