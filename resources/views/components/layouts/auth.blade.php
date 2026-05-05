<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DO RULES') }} - Auth</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans text-slate-600 antialiased bg-white selection:bg-teal-500 selection:text-white h-screen overflow-hidden">
    
    <div class="flex h-full w-full">
        
        <!-- Left Side (Branding) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-teal-900 to-teal-700 flex-col justify-center items-center p-12 overflow-hidden">
            
            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-teal-300/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 text-center max-w-lg">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20 backdrop-blur-sm">
                        <svg class="w-10 h-10 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                </div>
                
                <h1 class="text-4xl font-heading font-bold text-white mb-2">DO RULES</h1>
                <p class="text-teal-200 text-lg mb-12">Sistem Disiplin Sekolah Modern</p>
                
                <!-- Illustration Placeholder -->
                <div class="w-full h-64 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm p-6 mb-12 flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-teal-400/20 rounded-full blur-xl"></div>
                    <div class="absolute -left-4 -bottom-4 w-32 h-32 bg-teal-300/20 rounded-full blur-xl"></div>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="h-4 w-3/4 bg-white/20 rounded"></div>
                        <div class="h-4 w-full bg-white/10 rounded"></div>
                        <div class="h-4 w-5/6 bg-white/10 rounded"></div>
                        <div class="h-4 w-2/3 bg-white/10 rounded"></div>
                    </div>
                </div>
                
                <blockquote class="text-teal-100/80 italic text-lg border-l-4 border-teal-500 pl-4 text-left">
                    "Disiplin adalah jembatan antara tujuan dan pencapaian."
                </blockquote>
            </div>
        </div>

        <!-- Right Side (Form) -->
        <div class="w-full lg:w-1/2 flex flex-col relative overflow-y-auto">
            
            <!-- Back to Home -->
            <a href="/" class="absolute top-6 left-6 flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-teal-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>

            <div class="flex-1 flex flex-col justify-center items-center p-8 sm:p-12 md:p-24">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>

            <!-- Help Link -->
            <div class="p-6 text-center">
                <p class="text-sm text-slate-500">
                    Butuh bantuan? <a href="#" class="text-teal-600 hover:text-teal-700 font-medium transition-colors">Hubungi kami</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
