<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DO RULES') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js (Fallback if not in app.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased font-sans text-white bg-[#041c10] overflow-x-hidden selection:bg-emerald-500 selection:text-white" x-data="{ show: false }" x-init="setTimeout(() => show = true, 150)">
    
    <!-- Background Glows -->
    <div class="fixed top-1/4 left-1/4 w-[500px] h-[500px] bg-emerald-600/20 rounded-full blur-[128px] animate-pulse pointer-events-none"></div>
    <div class="fixed bottom-1/4 right-1/4 w-[500px] h-[500px] bg-[#3ebd7e]/20 rounded-full blur-[128px] pointer-events-none delay-1000"></div>

    <!-- Navigation -->
    <nav class="absolute top-0 w-full z-50 px-6 py-6" x-show="show" x-transition.opacity.duration.1000ms>
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold tracking-tighter">
                Do-<span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-white">Rules</span>
            </div>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-emerald-100 hover:text-white transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-emerald-100 hover:text-white transition-colors">
                            Log in
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Section -->
    <main class="relative min-h-screen flex items-center justify-center px-6 py-20 z-10">
        <div class="w-full max-w-7xl grid md:grid-cols-2 gap-16 items-center">
            
            <!-- Left Side: Copywriting & CTA -->
            <div x-show="show" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 -translate-x-12"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="space-y-8">
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-emerald-200 tracking-wide uppercase">Sistem Manajemen Sekolah Modern</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold leading-tight tracking-tight text-white">
                    Bangun Karakter, <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-[#e6f4ed]">Ciptakan Disiplin.</span>
                </h1>
                
                <p class="text-lg text-emerald-100/70 leading-relaxed max-w-lg">
                    Platform digital terintegrasi untuk memantau ketertiban siswa secara real-time, 
                    membangun lingkungan belajar yang kondusif, dan melibatkan orang tua secara langsung.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                            Mulai Sekarang
                        </a>
                    @endauth
                    
                    <a href="#features" class="px-8 py-4 rounded-full bg-white/5 hover:bg-white/10 text-white font-semibold backdrop-blur-md border border-white/10 transition-all hover:scale-105 active:scale-95">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <!-- Right Side: Floating Glass Cards -->
            <div class="relative h-[500px] hidden md:block"
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-1000 delay-300"
                 x-transition:enter-start="opacity-0 translate-x-12"
                 x-transition:enter-end="opacity-100 translate-x-0">
                
                <!-- Center Main Card -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-96 bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[2rem] p-8 shadow-2xl flex flex-col justify-between z-20">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 flex items-center justify-center mb-6 border border-emerald-500/30">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Laporan Instan</h3>
                        <p class="text-sm text-emerald-100/60">Setiap pelanggaran tercatat dan ternotifikasi dalam hitungan detik.</p>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-[#3ebd7e] w-[70%] rounded-full"></div>
                        </div>
                        <div class="flex justify-between text-xs text-emerald-100/50">
                            <span>Efisiensi Sistem</span>
                            <span>99%</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Stat 1 -->
                <div class="absolute top-10 right-0 w-48 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-4 shadow-xl z-30 animate-[bounce_5s_infinite]">
                    <div class="text-3xl font-bold text-white mb-1">10K+</div>
                    <div class="text-xs text-emerald-200/70 font-medium">Siswa Terpantau Aktif</div>
                </div>

                <!-- Floating Stat 2 -->
                <div class="absolute bottom-20 left-0 w-56 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-5 shadow-xl z-30 animate-[bounce_6s_infinite_reverse]">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-emerald-500/30 flex items-center justify-center border border-emerald-400/30">
                            <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-white">50+</div>
                            <div class="text-[10px] text-emerald-200/70 font-medium uppercase tracking-wider">Sekolah Mitra</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
