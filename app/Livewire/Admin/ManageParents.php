<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ParentModel;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class ManageParents extends Component
{
    public $name, $phone, $email, $address, $parent_id;
    public $search = '';
    public $isEdit = false;
    public $showForm = false;

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        ParentModel::updateOrCreate(
            ['id' => $this->parent_id],
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
            ]
        );

        session()->flash('message', 'Data orang tua berhasil disimpan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);

        $this->parent_id = $id;
        $this->name = $parent->name;
        $this->phone = $parent->phone;
        $this->email = $parent->email;
        $this->address = $parent->address;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        ParentModel::find($id)?->delete();
        session()->flash('message', 'Data orang tua berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['name','phone','email','address','parent_id']);
        $this->isEdit = false;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.admin.manage-parents', [
            'parents' => ParentModel::when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->latest()->get()
        ]);
    }
}
