<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8 min-h-screen">
    
    {{-- BAR HEADER --}}
    <div class="mb-6 border-b border-slate-200 pb-4">
        <h1 class="text-xl font-bold text-slate-800 tracking-tight">Formulir Lapor Pelanggaran</h1>
        <p class="text-xs text-slate-500 mt-1">
            Gunakan form ini untuk mencatat tindakan indispliner siswa secara langsung di lapangan.
        </p>
    </div>

    {{-- NOTIFIKASI SUKSES --}}
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-lg flex items-center gap-3 shadow-sm animate-fade-in">
            <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    {{-- KARTU FORM UTAMA --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <form wire:submit.prevent="saveViolation" class="p-6 space-y-5">
            
            {{-- DROPDOWN SELEKSI SISWA --}}
            <div class="space-y-1.5">
                <label for="student_id" class="block text-xs font-bold text-slate-700 tracking-wide uppercase">Pilih Siswa</label>
                <div class="relative">
                    <select wire:model="student_id" id="student_id" 
                        class="block w-full pl-3 pr-10 py-2 border @error('student_id') border-red-300 focus:ring-red-200 focus:border-red-500 @else border-slate-300 focus:ring-teal-500 focus:border-teal-500 @enderror rounded-lg text-sm bg-white text-slate-800 focus:outline-none focus:ring-2 transition-all">
                        <option value="">-- Pilih Nama Siswa / Murid --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} (NIS: {{ $student->nis }})</option>
                        @endforeach
                    </select>
                </div>
                @error('student_id') 
                    <p class="text-xs font-medium text-red-600 mt-1 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- DROPDOWN SELEKSI ATURAN PELANGGARAN --}}
            <div class="space-y-1.5">
                <label for="rule_id" class="block text-xs font-bold text-slate-700 tracking-wide uppercase">Jenis Pelanggaran</label>
                <div class="relative">
                    <select wire:model="rule_id" id="rule_id" 
                        class="block w-full pl-3 pr-10 py-2 border @error('rule_id') border-red-300 focus:ring-red-200 focus:border-red-500 @else border-slate-300 focus:ring-teal-500 focus:border-teal-500 @enderror rounded-lg text-sm bg-white text-slate-800 focus:outline-none focus:ring-2 transition-all">
                        <option value="">-- Pilih Aturan / Pasal Pelanggaran --</option>
                        @foreach($rules as $rule)
                            <option value="{{ $rule->id }}">{{ $rule->name }} ({{ $rule->point }} Poin)</option>
                        @endforeach
                    </select>
                </div>
                @error('rule_id') 
                    <p class="text-xs font-medium text-red-600 mt-1 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- INPUT KRONOLOGI / CATATAN --}}
            <div class="space-y-1.5">
                <label for="notes" class="block text-xs font-bold text-slate-700 tracking-wide uppercase">Kronologi & Keterangan <span class="text-[10px] font-normal text-slate-400 capitalize">(Opsional)</span></label>
                <textarea wire:model="notes" id="notes" rows="3" placeholder="Tuliskan rincian atau keterangan tambahan kejadian..."
                    class="block w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-slate-800 placeholder-slate-400 resize-none bg-white transition-all"></textarea>
                @error('notes') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- UPLOAD BUKTI DENGAN AKSES KAMERA LANGSUNG --}}
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 tracking-wide uppercase">Foto Bukti Pelanggaran</label>
                
                <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-xl p-5 bg-slate-50 hover:bg-slate-100/60 transition-colors group">
                    {{-- Atribut capture="environment" mengaktifkan kamera belakang HP secara instan --}}
                    <input type="file" wire:model="evidence" accept="image/*" capture="environment"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    
                    <div class="text-center space-y-1.5">
                        <div class="mx-auto h-10 w-10 text-slate-400 bg-white p-2 rounded-lg border border-slate-200 shadow-sm flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <circle cx="12" cy="13" r="3" stroke-width="2"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-slate-600">Klik untuk ambil gambar dari kamera</p>
                        <p class="text-[10px] text-slate-400">Format gambar maks. 2MB</p>
                    </div>
                </div>

                {{-- Indikator Proses Pengunggahan File --}}
                <div wire:loading wire:target="evidence" class="text-[11px] text-teal-600 font-medium animate-pulse mt-1.5 flex items-center gap-1">
                    <svg class="animate-spin h-3 w-3 text-teal-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sedang memproses & mengunggah gambar...
                </div>

                @error('evidence')
                    <p class="text-xs font-medium text-red-600 mt-1">⚠️ {{ $message }}</p>
                @enderror

                {{-- Live Preview Hasil Tangkapan Kamera --}}
                @if($evidence)
                    <div class="mt-3 relative rounded-lg overflow-hidden border border-slate-200 bg-slate-100 p-1">
                        <img src="{{ $evidence->temporaryUrl() }}" class="rounded w-full h-44 object-cover">
                        <div class="absolute top-3 right-3 bg-slate-900/80 text-white text-[9px] font-semibold px-2 py-0.5 rounded shadow backdrop-blur-sm">
                            Preview Gambar
                        </div>
                    </div>
                @endif
            </div>

            {{-- FOOTER / AKSI TOMBOL --}}
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                <button type="button" 
                    onclick="window.history.back()"
                    class="px-3.5 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-colors">
                    Kembali
                </button>
                <button type="submit" wire:loading.attr="disabled" wire:target="saveViolation, evidence"
                    class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-all flex items-center gap-1.5 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="saveViolation">Simpan Laporan</span>
                    <span wire:loading wire:target="saveViolation" class="w-3.5 h-3.5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                    <span wire:loading wire:target="saveViolation">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>