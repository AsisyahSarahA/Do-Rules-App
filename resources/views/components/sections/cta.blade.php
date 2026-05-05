<section class="py-24 relative overflow-hidden bg-gradient-to-br from-teal-700 to-teal-900">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-400 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-teal-300 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center" x-data="{ shown: false }" x-intersect.once="shown = true">
        <h2 x-show="shown" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl md:text-5xl font-heading font-bold text-white mb-6">
            Siap Mewujudkan Sekolah Lebih Disiplin?
        </h2>
        <p x-show="shown" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-xl text-teal-100 mb-10">
            Bergabung dengan sekolah lain yang telah menggunakan DO RULES untuk membangun karakter unggul siswanya.
        </p>
        
        <div x-show="shown" x-transition:enter="transition ease-out duration-700 delay-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
            <x-ui.button href="{{ route('register') }}" variant="white" size="lg" class="w-full sm:w-auto px-8">
                Daftar Sekarang - Gratis
            </x-ui.button>
            <x-ui.button href="#" variant="outline-white" size="lg" class="w-full sm:w-auto px-8">
                Hubungi Kami
            </x-ui.button>
        </div>

        <!-- Trust Badges -->
        <div x-show="shown" x-transition:enter="transition ease-out duration-700 delay-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="flex flex-wrap items-center justify-center gap-6 text-teal-200 text-sm font-medium">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span>Data Aman</span>
            </div>
            <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-teal-500"></div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span>Setup Cepat</span>
            </div>
            <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-teal-500"></div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <span>Support 24/7</span>
            </div>
        </div>
    </div>
</section>
