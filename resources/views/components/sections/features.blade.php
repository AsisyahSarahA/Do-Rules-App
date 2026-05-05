<section id="features" class="py-24 bg-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true">
            <h2 x-show="shown" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-3xl md:text-4xl font-heading font-bold text-teal-900 mb-4">
                Kenapa Memilih DO RULES?
            </h2>
            <p x-show="shown" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-lg text-slate-600">
                Fitur lengkap untuk manajemen disiplin sekolah yang efektif dan transparan.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Feature 1 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Laporan Dalam 30 Detik</h3>
                <p class="text-slate-600">Guru dapat melaporkan pelanggaran dengan form sederhana, tanpa ribet mengisi berkas manual.</p>
            </x-ui.card>

            <!-- Feature 2 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Sistem Verifikasi Piket</h3>
                <p class="text-slate-600">Setiap laporan diverifikasi oleh guru piket untuk memastikan akurasi data sebelum masuk ke sistem.</p>
            </x-ui.card>

            <!-- Feature 3 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Poin Terupdate Real-time</h3>
                <p class="text-slate-600">Sistem menghitung poin secara otomatis berdasarkan bobot pelanggaran yang telah diatur oleh sekolah.</p>
            </x-ui.card>

            <!-- Feature 4 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-400" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Orang Tua Terinformasi</h3>
                <p class="text-slate-600">Surat peringatan otomatis terkirim melalui notifikasi digital ke orang tua saat batas poin tercapai.</p>
            </x-ui.card>

            <!-- Feature 5 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-500" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Kompetisi Positif</h3>
                <p class="text-slate-600">Motivasi kelas untuk disiplin melalui fitur ranking kelas tertib yang ditampilkan transparan.</p>
            </x-ui.card>

            <!-- Feature 6 -->
            <x-ui.card x-data="{ shown: false }" x-intersect.once="shown = true" x-show="shown" x-transition:enter="transition ease-out duration-500 delay-600" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="group">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-teal-900 mb-3">Data-Driven Decision</h3>
                <p class="text-slate-600">Dashboard analitik lengkap untuk membantu sekolah mengevaluasi dan merumuskan kebijakan yang tepat.</p>
            </x-ui.card>

        </div>
    </div>
</section>
