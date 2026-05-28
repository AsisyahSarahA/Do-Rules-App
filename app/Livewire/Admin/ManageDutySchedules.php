<?php

namespace App\Livewire\Admin;

use App\Models\DutySchedule;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ManageDutySchedules extends Component
{
    public $schedules;
    public $teachers;
    
    // Modal Add State
    public $showAddModal = false;
    public $selectedTeacherId = '';
    public $dutyDate = '';

    public function mount()
    {
        $this->loadSchedules();
        // Get all teachers
        $this->teachers = User::where('role', 'guru')->get();
        // Default duty date to today
        $this->dutyDate = date('Y-m-d');
    }

    public function loadSchedules()
    {
        // Load all future and today schedules, order by date
        $this->schedules = DutySchedule::with('user')
            ->orderBy('duty_date', 'asc')
            ->get();
    }

    public function openAddModal()
    {
        $this->selectedTeacherId = '';
        $this->dutyDate = date('Y-m-d');
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->resetValidation();
    }

    public function addSchedule()
    {
        $this->validate([
            'selectedTeacherId' => 'required|exists:users,id',
            'dutyDate' => 'required|date',
        ], [
            'selectedTeacherId.required' => 'Pilih guru terlebih dahulu.',
            'dutyDate.required' => 'Tanggal piket wajib diisi.',
        ]);

        // Check if already exists for that user and date
        $exists = DutySchedule::where('user_id', $this->selectedTeacherId)
            ->where('duty_date', $this->dutyDate)
            ->exists();

        if ($exists) {
            $this->addError('dutyDate', 'Guru ini sudah memiliki jadwal piket pada tanggal tersebut.');
            return;
        }

        DutySchedule::create([
            'user_id' => $this->selectedTeacherId,
            'duty_date' => $this->dutyDate,
        ]);

        $this->closeAddModal();
        $this->loadSchedules();
    }

    public function deleteSchedule($id)
    {
        $schedule = DutySchedule::find($id);
        if ($schedule) {
            $schedule->delete();
            $this->loadSchedules();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.manage-duty-schedules');
    }
}
