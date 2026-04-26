<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js (Fallback if not in app.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#041c10] text-white overflow-hidden selection:bg-emerald-500 selection:text-white" x-data="{ show: false }" x-init="setTimeout(() => show = true, 150)">
    
    <!-- Background Glows -->
    <div class="fixed top-1/4 left-1/4 w-[500px] h-[500px] bg-emerald-600/20 rounded-full blur-[128px] animate-pulse pointer-events-none z-0"></div>
    <div class="fixed bottom-1/4 right-1/4 w-[500px] h-[500px] bg-[#3ebd7e]/20 rounded-full blur-[128px] pointer-events-none delay-1000 z-0"></div>

    <!-- Main Content -->
    <div class="relative z-10 w-full min-h-screen flex items-center justify-center">
        {{ $slot }}
    </div>

</body>
</html>
