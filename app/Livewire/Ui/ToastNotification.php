<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use Livewire\Attributes\On;

class ToastNotification extends Component
{
    public $notifications = [];

    #[On('success')]
    public function success($message)
    {
        // Handle Livewire 3 positional/named arguments
        $msg = is_array($message) ? ($message['message'] ?? '') : $message;
        $this->addNotification($msg, 'success');
    }

    #[On('error')]
    public function error($message)
    {
        // Handle Livewire 3 positional/named arguments
        $msg = is_array($message) ? ($message['message'] ?? '') : $message;
        $this->addNotification($msg, 'error');
    }

    #[On('notify')]
    public function notify($message, $type = 'success')
    {
        $this->addNotification($message, $type);
    }

    private function addNotification($message, $type)
    {
        $id = uniqid();
        $notification = [
            'id' => $id,
            'message' => $message,
            'type' => $type,
        ];

        $this->notifications[] = $notification;

        $this->dispatch('toast-added', ...$notification);
    }

    public function remove($id)
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.ui.toast-notification');
    }
}
