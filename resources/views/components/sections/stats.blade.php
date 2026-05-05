<section class="py-12 bg-white relative z-20 -mt-8 sm:-mt-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Stat 1 -->
            <x-ui.card padding="p-6" class="flex items-center gap-4 border-none shadow-xl shadow-slate-200/50" x-data="{ shown: false }" x-intersect.once="shown = true">
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="w-14 h-14 rounded-full bg-teal-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="text-3xl font-heading font-bold text-teal-900">10K+</div>
                    <div class="text-sm font-medium text-slate-500">Siswa Terdaftar</div>
                </div>
            </x-ui.card>

            <!-- Stat 2 -->
            <x-ui.card padding="p-6" class="flex items-center gap-4 border-none shadow-xl shadow-slate-200/50" x-data="{ shown: false }" x-intersect.once="shown = true">
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="w-14 h-14 rounded-full bg-teal-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="text-3xl font-heading font-bold text-teal-900">50+</div>
                    <div class="text-sm font-medium text-slate-500">Sekolah Mitra</div>
                </div>
            </x-ui.card>

            <!-- Stat 3 -->
            <x-ui.card padding="p-6" class="flex items-center gap-4 border-none shadow-xl shadow-slate-200/50" x-data="{ shown: false }" x-intersect.once="shown = true">
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="w-14 h-14 rounded-full bg-teal-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-400" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="text-3xl font-heading font-bold text-teal-900">12K+</div>
                    <div class="text-sm font-medium text-slate-500">Pelanggaran Tercatat</div>
                </div>
            </x-ui.card>

            <!-- Stat 4 -->
            <x-ui.card padding="p-6" class="flex items-center gap-4 border-none shadow-xl shadow-slate-200/50" x-data="{ shown: false }" x-intersect.once="shown = true">
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-400" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="w-14 h-14 rounded-full bg-teal-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-500" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="text-3xl font-heading font-bold text-teal-900">99%</div>
                    <div class="text-sm font-medium text-slate-500">Kepuasan Pengguna</div>
                </div>
            </x-ui.card>

        </div>
    </div>
</section>
