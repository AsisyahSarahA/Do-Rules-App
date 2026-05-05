<section id="hero" class="relative min-h-screen flex items-center pt-24 pb-12 overflow-hidden bg-slate-900">
    <!-- Abstract Modern Background -->
    <div class="absolute inset-0 z-0">
        <!-- Base Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-teal-950 to-slate-900"></div>
        
        <!-- Glowing Orbs -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-teal-600/30 rounded-full blur-[120px] mix-blend-screen animate-pulse pointer-events-none" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[600px] h-[600px] bg-teal-400/20 rounded-full blur-[150px] mix-blend-screen animate-pulse pointer-events-none" style="animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-teal-800/20 rounded-full blur-[100px] pointer-events-none"></div>
        
        <!-- Subtle Grid (Very faint line grid, not crosses, for structure) -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
            
            <!-- Left Content -->
            <div x-data="{ shown: false }" 
                 x-intersect.once="shown = true" 
                 class="space-y-8 text-center lg:text-left">
                 
                <div x-show="shown" 
                     x-transition:enter="transition ease-out duration-700 delay-100"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-300/20 border border-teal-300/30 backdrop-blur-sm">
                    <span class="text-sm font-semibold text-teal-100 tracking-wide">🎯 Sistem Disiplin Sekolah Modern</span>
                </div>

                <h1 x-show="shown" 
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-4xl md:text-5xl lg:text-[52px] leading-tight font-heading font-bold text-white tracking-tight">
                    Mewujudkan Sekolah <br class="hidden lg:block"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-teal-100">Berdisiplin & Berkarakter</span>
                </h1>
                
                <p x-show="shown" 
                   x-transition:enter="transition ease-out duration-700 delay-500"
                   x-transition:enter-start="opacity-0 translate-y-4"
                   x-transition:enter-end="opacity-100 translate-y-0"
                   class="text-lg text-teal-100/90 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Platform digital untuk pencatatan pelanggaran siswa dengan sistem poin transparan dan terukur. Membangun lingkungan belajar yang lebih baik.
                </p>

                <div x-show="shown" 
                     x-transition:enter="transition ease-out duration-700 delay-700"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    
                    @auth
                        <x-ui.button href="{{ url('/dashboard') }}" variant="white" size="lg" class="w-full sm:w-auto px-8">
                            Masuk ke Dashboard
                        </x-ui.button>
                    @else
                        <x-ui.button href="{{ route('register') }}" variant="white" size="lg" class="w-full sm:w-auto px-8">
                            Mulai Sekarang
                        </x-ui.button>
                        <x-ui.button href="#features" variant="outline-white" size="lg" iconPosition="left" class="w-full sm:w-auto px-8">
                            <x-slot:icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </x-slot:icon>
                            Lihat Demo
                        </x-ui.button>
                    @endauth
                </div>

                <div x-show="shown" 
                     x-transition:enter="transition ease-out duration-700 delay-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="pt-8 flex items-center justify-center lg:justify-start gap-2 text-teal-200">
                    <svg class="w-5 h-5 text-teal-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">Digunakan oleh 10+ Sekolah</span>
                </div>
            </div>

            <!-- Right Content (Mockup/Illustration) -->
            <div class="hidden lg:block relative h-[600px] w-full"
                 x-data="{ shown: false }" 
                 x-intersect.once="shown = true">
                
                <!-- Floating Shapes for depth -->
                <div class="absolute top-1/4 -left-12 w-24 h-24 bg-teal-400/20 rounded-full blur-xl animate-float" style="animation-delay: 0s;"></div>
                <div class="absolute bottom-1/3 -right-8 w-32 h-32 bg-teal-300/20 rounded-full blur-xl animate-float" style="animation-delay: 1.5s;"></div>

                <div x-show="shown" 
                     x-transition:enter="transition ease-out duration-1000 delay-500"
                     x-transition:enter-start="opacity-0 translate-x-12"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     class="absolute inset-0 flex items-center justify-center">
                    
                    <!-- Main Mockup Card -->
                    <div class="relative w-full max-w-md aspect-[4/3] bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-2xl p-6 overflow-hidden z-20 hover:-translate-y-2 transition-transform duration-500">
                        <!-- Mockup Header -->
                        <div class="flex items-center justify-between mb-6 border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-teal-500/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-white font-medium text-sm">Ahmad Siswa</div>
                                    <div class="text-teal-200/70 text-xs">Kelas X-A</div>
                                </div>
                            </div>
                            <x-ui.badge variant="warning">50 Poin</x-ui.badge>
                        </div>
                        
                        <!-- Mockup Content -->
                        <div class="space-y-4">
                            <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="text-sm font-medium text-white">Terlambat Masuk</div>
                                    <span class="text-xs text-rose-300">+10 Poin</span>
                                </div>
                                <div class="text-xs text-teal-100/60">Hari ini, 07:15 WIB</div>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="text-sm font-medium text-white">Atribut Tidak Lengkap</div>
                                    <span class="text-xs text-rose-300">+15 Poin</span>
                                </div>
                                <div class="text-xs text-teal-100/60">Kemarin, 08:00 WIB</div>
                            </div>
                            
                            <!-- Mockup Chart placeholder -->
                            <div class="h-24 mt-4 w-full bg-gradient-to-t from-teal-500/20 to-transparent rounded-lg border-b-2 border-teal-400 flex items-end justify-between px-2 pt-8">
                                <div class="w-4 bg-teal-400/40 rounded-t h-[30%]"></div>
                                <div class="w-4 bg-teal-400/60 rounded-t h-[50%]"></div>
                                <div class="w-4 bg-teal-400/80 rounded-t h-[40%]"></div>
                                <div class="w-4 bg-teal-400 rounded-t h-[80%]"></div>
                                <div class="w-4 bg-teal-400/50 rounded-t h-[60%]"></div>
                                <div class="w-4 bg-teal-400/70 rounded-t h-[90%]"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Card 1 -->
                    <div class="absolute -right-8 top-1/4 w-48 bg-white/90 backdrop-blur-xl border border-white/20 rounded-xl p-4 shadow-xl z-30 animate-float" style="animation-delay: 0.5s;">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="text-sm font-bold text-slate-800">Verified</div>
                        </div>
                        <div class="text-xs text-slate-500">Laporan diverifikasi oleh Piket</div>
                    </div>

                    <!-- Floating Card 2 -->
                    <div class="absolute -left-12 bottom-1/3 w-56 bg-white/90 backdrop-blur-xl border border-white/20 rounded-xl p-4 shadow-xl z-30 animate-float" style="animation-delay: 2s;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-800">SP 1 Dikirim</div>
                                <div class="text-[10px] text-slate-500 uppercase tracking-wider">Ke Orang Tua</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
