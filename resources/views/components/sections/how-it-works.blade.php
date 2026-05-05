<section id="how-it-works" class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true">
            <h2 x-show="shown" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-3xl md:text-4xl font-heading font-bold text-teal-900 mb-4">
                Alur Sistem DO RULES
            </h2>
            <p x-show="shown" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-lg text-slate-600">
                Proses penanganan indisipliner yang jelas, transparan, dan terotomatisasi.
            </p>
        </div>

        <!-- Timeline Steps -->
        <div class="relative max-w-5xl mx-auto" x-data="{ shown: false }" x-intersect.once="shown = true">
            
            <!-- Connector Line (Desktop) -->
            <div x-show="shown" x-transition:enter="transition ease-in-out duration-1000 delay-500" x-transition:enter-start="scale-x-0" x-transition:enter-end="scale-x-100" class="hidden md:block absolute top-12 left-[10%] right-[10%] h-1 bg-teal-100 origin-left"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-4 relative">
                
                <!-- Step 1 -->
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative text-center group">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-teal-50 rounded-full flex items-center justify-center mb-4 relative z-10 group-hover:border-teal-200 transition-colors shadow-lg">
                        <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-teal-900 mb-2">1. Guru Melapor</h4>
                    <p class="text-xs text-slate-500 px-2">Guru melaporkan pelanggaran siswa melalui aplikasi.</p>
                </div>

                <!-- Step 2 -->
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative text-center group">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-teal-50 rounded-full flex items-center justify-center mb-4 relative z-10 group-hover:border-teal-200 transition-colors shadow-lg">
                        <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-teal-900 mb-2">2. Piket Verifikasi</h4>
                    <p class="text-xs text-slate-500 px-2">Guru piket memverifikasi laporan untuk validasi.</p>
                </div>

                <!-- Step 3 -->
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-500" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative text-center group">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-teal-50 rounded-full flex items-center justify-center mb-4 relative z-10 group-hover:border-teal-200 transition-colors shadow-lg">
                        <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-teal-900 mb-2">3. Sistem Proses</h4>
                    <p class="text-xs text-slate-500 px-2">Poin dihitung otomatis dan record tersimpan.</p>
                </div>

                <!-- Step 4 -->
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative text-center group">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-teal-50 rounded-full flex items-center justify-center mb-4 relative z-10 group-hover:border-teal-200 transition-colors shadow-lg">
                        <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-teal-900 mb-2">4. Notifikasi</h4>
                    <p class="text-xs text-slate-500 px-2">Siswa & orang tua mendapat notifikasi via sistem.</p>
                </div>

                <!-- Step 5 -->
                <div x-show="shown" x-transition:enter="transition ease-out duration-500 delay-900" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="relative text-center group">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-emerald-50 rounded-full flex items-center justify-center mb-4 relative z-10 group-hover:border-emerald-200 transition-colors shadow-lg">
                        <div class="w-16 h-16 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-[0_0_15px_rgba(16,185,129,0.5)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-teal-900 mb-2">5. Sanksi Selesai</h4>
                    <p class="text-xs text-slate-500 px-2">Siswa melaksanakan sanksi sesuai aturan sekolah.</p>
                </div>

            </div>
        </div>
    </div>
</section>
