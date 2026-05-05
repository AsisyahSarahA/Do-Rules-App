<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = '';
    public bool $terms = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:guru,siswa,ortu,admin'],
            'terms' => ['accepted']
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ];

        event(new Registered($user = User::create($userData)));

        Auth::login($user);

        if (auth()->user()->role === 'admin') {
            $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
            return;
        }

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="text-3xl font-heading font-bold text-slate-900 mb-2">Daftar Akun Baru</h2>
        <p class="text-slate-600 text-sm">Bergabung dengan DO RULES untuk mengelola disiplin sekolah</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        
        <!-- Name -->
        <x-ui.input 
            wire:model="name" 
            id="name" 
            name="name"
            type="text" 
            label="Nama Lengkap" 
            placeholder="Budi Santoso" 
            required 
            autofocus 
            autocomplete="name"
        >
            <x-slot:icon>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </x-slot:icon>
        </x-ui.input>

        <!-- Email -->
        <x-ui.input 
            wire:model="email" 
            id="email" 
            name="email"
            type="email" 
            label="Email" 
            placeholder="nama@sekolah.sch.id" 
            required 
            autocomplete="username"
        >
            <x-slot:icon>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
            </x-slot:icon>
        </x-ui.input>

        <!-- Role -->
        <div class="w-full">
            <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Daftar Sebagai</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <select wire:model="role" id="role" class="block w-full pl-10 rounded-md shadow-sm border-slate-300 focus:border-teal-500 focus:ring-teal-500 sm:text-sm" required>
                    <option value="">Pilih Peran...</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                    <option value="ortu">Orang Tua</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-rose-600" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Password -->
            <x-ui.input 
                wire:model="password" 
                id="password" 
                name="password"
                type="password" 
                label="Password" 
                placeholder="••••••••" 
                required 
                autocomplete="new-password"
            >
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </x-slot:icon>
            </x-ui.input>

            <!-- Confirm Password -->
            <x-ui.input 
                wire:model="password_confirmation" 
                id="password_confirmation" 
                name="password_confirmation"
                type="password" 
                label="Konfirmasi" 
                placeholder="••••••••" 
                required 
                autocomplete="new-password"
            >
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </x-slot:icon>
            </x-ui.input>
        </div>

        <!-- Terms -->
        <div class="flex items-start mt-2">
            <div class="flex items-center h-5">
                <input wire:model="terms" id="terms" type="checkbox" class="w-4 h-4 border border-slate-300 rounded bg-white focus:ring-3 focus:ring-teal-300 text-teal-600" required>
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-slate-600">Saya setuju dengan <a href="#" class="text-teal-600 hover:underline">Terms & Privacy Policy</a></label>
            </div>
        </div>
        <x-input-error :messages="$errors->get('terms')" class="mt-1 text-rose-600" />

        <!-- Submit Button -->
        <div class="pt-2">
            <x-ui.button type="submit" variant="primary" class="w-full relative" iconPosition="right">
                <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                <span wire:loading wire:target="register">Memproses...</span>
                <x-slot:icon>
                    <svg wire:loading.remove wire:target="register" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    <svg wire:loading wire:target="register" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </x-slot:icon>
            </x-ui.button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm text-slate-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" wire:navigate class="font-medium text-teal-600 hover:text-teal-800 transition-colors">Masuk di sini</a>
            </p>
        </div>
    </form>
</div>
