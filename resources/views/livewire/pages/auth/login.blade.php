<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.glass')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full max-w-7xl mx-auto px-6 py-12 md:py-20 flex flex-col items-center">
    
    <!-- Back Button -->
    <div class="w-full flex justify-start mb-8 z-50">
        <a href="/" class="flex items-center gap-2 text-emerald-100/70 hover:text-white transition-colors px-4 py-2 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10 backdrop-blur-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="w-full grid md:grid-cols-2 gap-12 lg:gap-24 items-center">
        
        <!-- Left Side: Branding -->
        <div class="hidden md:block" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-1000 delay-300"
             x-transition:enter-start="opacity-0 -translate-x-12"
             x-transition:enter-end="opacity-100 translate-x-0">
             
            <div class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tight">
                Do-<span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-[#e6f4ed]">Rules</span>
            </div>
            <p class="text-emerald-100/70 text-lg mb-10 leading-relaxed max-w-md">
                Platform digital untuk memantau ketertiban, membangun karakter, dan menciptakan lingkungan belajar yang kondusif.
            </p>
            
            <!-- Features List -->
            <div class="space-y-6">
                @php
                    $features = [
                        "Pantau pelanggaran siswa secara real-time",
                        "Sistem poin & sanksi otomatis",
                        "Laporan statistik lengkap & akurat",
                        "Kolaborasi Guru, Piket, dan Admin"
                    ];
                @endphp
                
                @foreach ($features as $index => $feature)
                    <div class="flex items-center gap-4 text-emerald-100/80">
                        <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></div>
                        </div>
                        <span class="font-medium">{{ $feature }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full max-w-md mx-auto relative"
             x-show="show" 
             x-transition:enter="transition ease-out duration-1000 delay-500"
             x-transition:enter-start="opacity-0 translate-x-12"
             x-transition:enter-end="opacity-100 translate-x-0">
             
            <div class="bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[2.5rem] p-8 md:p-10 shadow-2xl relative z-10">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang!</h2>
                    <p class="text-emerald-100/60 text-sm">Silakan masuk menggunakan akun terdaftar Anda.</p>
                </div>

                <x-auth-session-status class="mb-4 text-emerald-400" :status="session('status')" />

                <form wire:submit="login" class="space-y-6">
                    
                    <!-- Email / NIS / NIP -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-emerald-100/70 uppercase tracking-widest mb-2 ml-1">Email / NIP</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-100/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </span>
                            <input wire:model="form.email" id="email" type="email" required autofocus autocomplete="username"
                                class="w-full pl-11 pr-4 py-3.5 bg-black/20 border border-white/10 text-white placeholder-emerald-100/30 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 rounded-2xl text-sm transition-all" 
                                placeholder="Masukkan email anda">
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-rose-400 text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-emerald-100/70 uppercase tracking-widest mb-2 ml-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-100/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input wire:model="form.password" id="password" type="password" required autocomplete="current-password"
                                class="w-full pl-11 pr-4 py-3.5 bg-black/20 border border-white/10 text-white placeholder-emerald-100/30 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 rounded-2xl text-sm transition-all" 
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-rose-400 text-xs" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember" class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center">
                                <input wire:model="form.remember" id="remember" type="checkbox" class="peer sr-only">
                                <div class="w-5 h-5 bg-black/20 border border-white/20 rounded peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            <span class="ml-3 text-sm text-emerald-100/70 group-hover:text-white transition-colors">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 rounded-2xl transition-all hover:scale-[1.02] active:scale-[0.98] shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                            Masuk Sekarang
                        </button>
                    </div>

                </form>
            </div>
            
            <!-- Decorative Elements behind card -->
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-emerald-500/30 rounded-full blur-2xl z-0"></div>
            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-[#3ebd7e]/20 rounded-full blur-2xl z-0"></div>
        </div>

    </div>
</div>
