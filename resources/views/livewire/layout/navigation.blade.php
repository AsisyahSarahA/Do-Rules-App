<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="flex items-center gap-3 focus:outline-none transition-all hover:opacity-80">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-slate-500 font-medium uppercase tracking-tighter">{{ auth()->user()->role ?? 'Administrator' }}</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f172a&color=fff" class="w-10 h-10 rounded-2xl border-2 border-white shadow-md">
            
            <svg class="fill-current h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('profile')" wire:navigate>
            {{ __('Profile') }}
        </x-dropdown-link>

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
            <x-dropdown-link>
                {{ __('Log Out') }}
            </x-dropdown-link>
        </button>
    </x-slot>
</x-dropdown>
