<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-donezo-text">
        {{-- Welcome Notification --}}
        @if(session('welcome_message'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 60000)" 
                x-show="show"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:translate-x-4"
                x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed top-4 right-4 sm:top-8 sm:right-8 z-[9999] w-full max-w-sm"
            >
                <div class="bg-white border border-slate-100 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] p-5 pr-12 relative flex items-center gap-4 overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <div class="w-12 h-12 bg-teal-500 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-teal-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <p class="text-[10px] font-bold text-teal-600 uppercase tracking-widest mb-0.5">Berhasil Masuk</p>
                        <p class="text-slate-800 font-bold text-sm">{{ session('welcome_message') }}</p>
                    </div>

                    <button @click="show = false" class="absolute top-4 right-4 text-slate-300 hover:text-slate-500 transition-colors z-20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="min-h-screen bg-donezo-gray flex flex-col md:flex-row gap-6 p-4 md:p-6">
            
            <!-- Dynamic Sidebar -->
            <x-sidebar />

            <!-- Main Content Area -->
            <main class="flex-1 bg-donezo-gray min-w-0 flex flex-col">
                <!-- Dynamic Header -->
                <x-header />

                <!-- Page Specific Content -->
                {{ $slot }}
            </main>
        </div>
        <livewire:ui.confirm-modal />
        <livewire:ui.toast-notification />
    </body>
</html>
