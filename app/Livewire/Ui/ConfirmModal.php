<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use Livewire\Attributes\On;

class ConfirmModal extends Component
{
    public $isOpen = false;
    public $title = 'Hapus Data?';
    public $message = 'Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.';
    public $idToDelete = null;
    public $callbackMethod = 'delete';
    public $sourceComponent = null;

    #[On('confirmDelete')]
    public function show($id, $method = 'delete', $title = null, $message = null, $component = null)
    {
        $this->idToDelete = $id;
        $this->callbackMethod = $method;
        $this->sourceComponent = $component;
        if ($title) $this->title = $title;
        if ($message) $this->message = $message;
        
        $this->isOpen = true;
    }

    public function confirm()
    {
        if ($this->idToDelete) {
            if ($this->sourceComponent) {
                $this->dispatch('deleteConfirmed', id: $this->idToDelete)->to($this->sourceComponent);
            } else {
                $this->dispatch('deleteConfirmed', id: $this->idToDelete);
            }
            
            $this->isOpen = false;
            $this->reset(['idToDelete', 'callbackMethod', 'title', 'message']);
        }
    }

    public function cancel()
    {
        $this->isOpen = false;
        $this->reset(['idToDelete', 'callbackMethod', 'title', 'message']);
    }

    public function render()
    {
        return view('livewire.ui.confirm-modal');
    }
}
