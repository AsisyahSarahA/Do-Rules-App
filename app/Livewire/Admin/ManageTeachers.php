<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\Attributes\Layout;
use App\Models\User;


use Livewire\WithPagination;
use Livewire\Attributes\On;


#[Layout('layouts.app')]
class ManageTeachers extends Component
{
    use WithPagination;

    public $name, $nip, $phone, $email, $teacherId;
    public $isEdit = false;
    public $showForm = false;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // ================= SAVE =================
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'nip' => 'required|unique:teachers,nip,' . $this->teacherId,
            'phone' => 'nullable',
            'email' => 'nullable|email',
        ]);

        Teacher::updateOrCreate(
            ['id' => $this->teacherId],
            [
                'name' => $this->name,
                'nip' => $this->nip,
                'phone' => $this->phone,
                'email' => $this->email,
            ]
        );

        $this->dispatch('success', message: 'Data guru berhasil disimpan!');

        $this->resetForm();
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        $this->teacherId = $teacher->id;
        $this->name = $teacher->name;
        $this->nip = $teacher->nip;
        $this->phone = $teacher->phone;
        $this->email = $teacher->email;

        $this->isEdit = true;
        $this->showForm = true;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        Teacher::find($id)?->delete();
        $this->dispatch('success', message: 'Data guru berhasil dihapus!');
    }

    // ================= RESET =================
    public function resetForm()
    {
        $this->reset(['name', 'nip', 'phone', 'email', 'teacherId']);
        $this->isEdit = false;
        $this->showForm = false;
    }

    // ================= RENDER =================
    public function render()
    {
        $teachers = User::whereIn('role', ['guru', 'wali_kelas', 'piket'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.manage-teachers', [
            'teachers' => $teachers
        ]);
    }

    public function setRole($id, $role)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => $role]);

        $this->dispatch('success', message: 'Role berhasil diupdate!');
    }

}
