<aside class="w-full md:w-64 flex flex-col bg-white border-r border-donezo-border min-h-screen py-6 px-4" x-data="{
        masterOpen: {{ request()->routeIs(
            'admin.manage-classes',
            'admin.rules',
            'admin.students',
            'admin.teachers',
            'admin.parents',
            'admin.violations'
        ) ? 'true' : 'false' }}
    }">

    <!-- Logo -->
    <div class="flex items-center gap-3 mb-10 px-4">
        <div class="w-8 h-8 rounded-full flex items-center justify-center text-donezo-primary">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                <path d="M9 12l2 2 4-4"></path>
            </svg>
        </div>

        <h1 class="text-xl font-bold tracking-tight text-donezo-text">
            DO RULES
        </h1>
    </div>

    @php
    $role = auth()->user()->role ?? 'guest';
    @endphp

    <!-- MENU -->
    <div class="mb-4 px-4 overflow-y-auto flex-1">

        <p class="text-xs font-semibold text-gray-400 mb-4 tracking-wider uppercase">
            Menu Utama
        </p>

        <nav class="space-y-1.5">

            <!-- Dashboard -->
            <div class="relative group">

                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-donezo-primary rounded-r-md
                    {{ request()->routeIs('admin.dashboard') ? 'block' : 'hidden' }}">
                </div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg
                    {{ request()->routeIs('admin.dashboard')
                        ? 'text-donezo-text font-bold bg-gray-50'
                        : 'text-gray-500 font-medium hover:text-donezo-text hover:bg-gray-50'
                    }} transition-colors">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5
                            {{ request()->routeIs('admin.dashboard')
                                ? 'text-donezo-primary'
                                : 'text-gray-400'
                            }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>

                        <span>Dashboard</span>
                    </div>
                </a>
            </div>

            <!-- DATA MASTER -->
            <div>

                <button @click="masterOpen = !masterOpen" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg
                    {{ request()->routeIs(
                        'admin.manage-classes',
                        'admin.rules',
                        'admin.students',
                        'admin.teachers',
                        'admin.parents',
                        'admin.violations'
                    )
                        ? 'text-donezo-text font-bold bg-gray-50'
                        : 'text-gray-500 font-medium hover:text-donezo-text hover:bg-gray-50'
                    }} transition-colors">

                    <div class="flex items-center gap-3">

                        <svg class="w-5 h-5
                            {{ request()->routeIs(
                                'admin.manage-classes',
                                'admin.rules',
                                'admin.students',
                                'admin.teachers',
                                'admin.parents',
                                'admin.violations'
                            )
                                ? 'text-donezo-primary'
                                : 'text-gray-400'
                            }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>

                        <span>Data Master</span>
                    </div>

                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': masterOpen}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="masterOpen" x-collapse class="mt-1 space-y-1 pl-11 pr-2">

                    <a href="{{ route('admin.manage-classes') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.manage-classes')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Data Kelas
                    </a>

                    <a href="{{ route('admin.rules') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.rules')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Data Peraturan
                    </a>

                    <a href="{{ route('admin.students') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.students')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Data Siswa
                    </a>

                    <a href="{{ route('admin.teachers') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.teachers')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Data Guru
                    </a>

                    <a href="{{ route('admin.parents') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.parents')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Data Orang Tua
                    </a>

                    <a href="{{ route('admin.violations') }}" class="block px-3 py-2 text-sm rounded-lg
                        {{ request()->routeIs('admin.violations')
                            ? 'text-donezo-primary font-bold bg-teal-50'
                            : 'text-gray-500 hover:text-donezo-text hover:bg-gray-50'
                        }} transition-colors">
                        Input Pelanggaran
                    </a>

                </div>
            </div>

            <!-- VERIFIKASI -->
            <div class="relative group">

                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-donezo-primary rounded-r-md
                    {{ request()->routeIs('admin.verify-violations') ? 'block' : 'hidden' }}">
                </div>

                <a href="{{ route('admin.verify-violations') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg
                    {{ request()->routeIs('admin.verify-violations')
                        ? 'text-donezo-text font-bold bg-gray-50'
                        : 'text-gray-500 font-medium hover:text-donezo-text hover:bg-gray-50'
                    }} transition-colors">

                    <div class="flex items-center gap-3">

                        <svg class="w-5 h-5
                            {{ request()->routeIs('admin.verify-violations')
                                ? 'text-donezo-primary'
                                : 'text-gray-400'
                            }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>

                        <span>Verifikasi Pelanggaran</span>
                    </div>

                    @php
                    $pendingCount = \App\Models\Violation::where('status', 'pending')->count();
                    @endphp

                    @if($pendingCount > 0)
                    <span class="bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md animate-pulse">
                        {{ $pendingCount }}
                    </span>
                    @endif

                </a>
            </div>

        </nav>
    </div>

    <!-- GENERAL -->
    <div class="mb-4 px-4 mt-2">

        <p class="text-xs font-semibold text-gray-400 mb-3 tracking-wider uppercase">
            General
        </p>

        <nav class="space-y-1">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-rose-500 font-medium hover:text-rose-600 hover:bg-rose-50 transition-colors w-full text-left">

                    <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>

                    <span>Logout</span>
                </button>
            </form>

        </nav>
    </div>

    <!-- USER CARD -->
    <div class="mt-auto px-4 pb-4">

        <div
            class="bg-gradient-to-br from-[#0c2a1a] to-donezo-dark rounded-2xl p-4 text-white relative overflow-hidden shadow-lg shadow-donezo-dark/30 flex items-center gap-3">

            <svg class="absolute bottom-0 right-0 w-full h-full opacity-30 pointer-events-none" viewBox="0 0 100 100"
                preserveAspectRatio="none">

                <path d="M0,100 Q30,50 100,80 L100,100 Z" fill="#3ebd7e" />
                <path d="M0,100 Q50,20 100,60 L100,100 Z" fill="#175e3a" opacity="0.5" />
            </svg>

            <div
                class="relative z-10 w-10 h-10 rounded-full bg-teal-500/30 border border-teal-400/50 flex items-center justify-center font-bold text-lg">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="relative z-10 flex-1 overflow-hidden">
                <h4 class="font-bold text-sm truncate">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </h4>

                <p class="text-[10px] text-teal-200 uppercase tracking-widest">
                    {{ $role }}
                </p>
            </div>

        </div>
    </div>
</aside>
