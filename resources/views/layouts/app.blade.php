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
    </body>
</html>
