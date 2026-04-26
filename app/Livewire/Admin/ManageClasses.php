<?php

namespace App\Livewire\Admin;

use App\Models\ClassRoom;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\User;


class ManageClasses extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]

    public $name, $wali_kelas_id, $school_year, $selected_id;
    public $showForm = false;
    public $isEdit = false;
    public $search = '';

    // Di dalam render()
    public function render()
    {
        return view('livewire.admin.manage-classes', [
            'classes' => ClassRoom::with('wali_kelas')
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
            'teachers' => User::where('role', 'wali_kelas')->get() // Sesuaikan role guru kamu
        ]);
    }

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
}
