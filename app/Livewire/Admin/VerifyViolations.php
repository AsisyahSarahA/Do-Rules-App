<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Violation;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class VerifyViolations extends Component
{
    public $search = '';

    public function verify($id)
    {
        app(\App\Http\Controllers\VerificationController::class)
            ->verify($id);

        $this->dispatch('success', message: 'Pelanggaran berhasil diverifikasi!');
    }

    public function render()
    {
        $violations = Violation::with(['student', 'rule'])
            ->where('status', 'pending')
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('nis', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->get();

        return view('livewire.admin.verify-violations', [
            'violations' => $violations
        ]);
    }
}