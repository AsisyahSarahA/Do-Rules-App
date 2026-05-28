<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // 1. PERBAIKAN: Validasi diarahkan ke form object agar tidak MissingRulesException
        $this->form->validate();

        // 2. Jalankan autentikasi (cek email & password)
        $this->form->authenticate();

        Session::regenerate();

        $user = auth()->user();

        // Simpan pesan sapaan ke session
        session()->flash('welcome_message', "Selamat datang, {$user->name}! 👋");

        // 3. LOGIKA REDIRECT CUSTOM BERDASARKAN ROLE & DATA

        // JALUR 1: Jika dia Admin
        if ($user->role === 'admin') {
            $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
            return;
        }

        // JALUR 2: Jika dia Siswa (dicek apakah datanya ada di tabel students)
        if ($user->student()->exists()) {
            $this->redirect(route('student.dashboard', absolute: false), navigate: true);
            return;
        }

        // JALUR 3: Default (Guru / Guru Piket) diarahkan ke halaman pelanggaran
        $this->redirectIntended(default: url('teachers/violations'), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="text-3xl font-heading font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
        <p class="text-slate-600 text-sm">Masuk untuk mengakses dashboard DO RULES</p>
    </div>

    <x-auth-session-status class="mb-4 text-teal-600 bg-teal-50 p-3 rounded-lg text-sm" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">

        <x-ui.input
            wire:model="form.email"
            id="email"
            name="email"
            type="email"
            label="Email"
            placeholder="nama@sekolah.sch.id"
            required
            autofocus
            autocomplete="username"
        >
            <x-slot:icon>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
            </x-slot:icon>
        </x-ui.input>

        <x-ui.input
            wire:model="form.password"
            id="password"
            name="password"
            type="password"
            label="Password"
            placeholder="••••••••"
            required
            autocomplete="current-password"
        >
            <x-slot:icon>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </x-slot:icon>
        </x-ui.input>

        <div class="flex items-center justify-between">
            <label for="remember" class="flex items-center cursor-pointer group">
                <div class="relative flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="peer sr-only">
                    <div class="w-5 h-5 bg-white border-2 border-slate-300 rounded peer-checked:bg-teal-600 peer-checked:border-teal-600 transition-all flex items-center justify-center">
                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
                <span class="ml-3 text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-teal-600 hover:text-teal-800 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-ui.button type="submit" variant="primary" class="w-full relative" iconPosition="right">
                <span wire:loading.remove wire:target="login">Masuk</span>
                <span wire:loading wire:target="login">Memproses...</span>
                <x-slot:icon>
                    <svg wire:loading.remove wire:target="login" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    <svg wire:loading wire:target="login" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </x-slot:icon>
            </x-ui.button>
        </div>

        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-slate-400">Atau masuk dengan</span>
            </div>
        </div>

        <div>
            <x-ui.button type="button" variant="outline" class="w-full bg-white text-slate-700 border-slate-300 hover:bg-slate-50 focus:ring-slate-500" iconPosition="left">
                <x-slot:icon>
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                </x-slot:icon>
                Masuk dengan Google
            </x-ui.button>
        </div>

        <div class="text-center pt-4">
            <p class="text-sm text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" wire:navigate class="font-medium text-teal-600 hover:text-teal-800 transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </form>
</div>
