<div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800">
                Laporan Pelanggaran Saya
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Input dan pantau riwayat pelaporan pelanggaran siswa Anda
            </p>
        </div>

        <button wire:click="{{ $showForm ? 'resetForm' : '$set(\'showForm\', true)' }}"
            class="{{ $showForm ? 'bg-slate-200 text-slate-600' : 'bg-teal-500 text-white' }} px-6 py-3 rounded-2xl font-bold shadow-lg transition-all">
            {{ $showForm ? 'Tutup Form' : '+ Laporkan Pelanggaran' }}
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- FORM INPUT/EDIT --}}
        @if($showForm)
        <div class="lg:col-span-4">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-8">
                    {{ $isEdit ? 'Edit Laporan' : 'Input Pelanggaran Baru' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-5">
                    {{-- Siswa --}}
                    <div>
                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">Siswa</label>
                        <select wire:model="student_id" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Pilih siswa</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Peraturan --}}
                    <div>
                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">Peraturan</label>
                        <select wire:model="rule_id" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Pilih peraturan</option>
                            @foreach($rules as $rule)
                                <option value="{{ $rule->id }}">{{ $rule->name }} ({{ $rule->point }} Point)</option>
                            @endforeach
                        </select>
                        @error('rule_id') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">Catatan / Kronologi</label>
                        <textarea wire:model="notes" rows="4" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-teal-500/20" placeholder="Tulis catatan pelanggaran jika ada..."></textarea>
                        @error('notes') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload Bukti --}}
                    <div>
                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">Bukti Foto</label>
                        <input type="file" wire:model="evidence" accept="image/*" capture="environment"
                            x-on:change="if($event.target.files[0] && $event.target.files[0].size > 2 * 1024 * 1024) { alert('⚠️ Ukuran file terlalu besar! Maksimal 2MB.'); }"
                            class="w-full bg-gray-50 rounded-2xl px-5 py-4 text-sm">

                        @error('evidence')
                            <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase tracking-widest">{{ $message }}</p>
                        @enderror

                        @if($evidence)
                            <img src="{{ $evidence->temporaryUrl() }}" class="mt-4 rounded-2xl w-full h-52 object-cover border">
                        @endif
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full bg-teal-500 hover:bg-teal-600 text-white py-4 rounded-2xl font-bold transition-all disabled:opacity-50 flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="save">{{ $isEdit ? 'Update Laporan' : 'Kirim Laporan' }}</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>

                        @if($isEdit)
                        <button type="button" wire:click="resetForm" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 py-4 rounded-2xl font-bold transition-all">
                            Batal Edit
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @endif

        {{-- TABLE RIWAYAT --}}
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }}">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                
                {{-- FILTERS --}}
                <div class="p-6 border-b border-gray-100 flex flex-wrap items-center gap-4 bg-gray-50/50">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" wire:model.live="search" placeholder="Cari nama siswa / NIS..."
                            class="w-full bg-white border-gray-200 rounded-2xl px-5 py-2.5 focus:ring-2 focus:ring-teal-500/20 text-sm">
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <input type="date" wire:model.live="filterDay" class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20">

                        <select wire:model.live="filterMonth" class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Semua Bulan</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="filterYear" class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Semua Tahun</option>
                            @foreach(range(date('Y') - 2, date('Y')) as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- TABLE STREAM --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-[11px] uppercase tracking-[0.2em] text-gray-400 bg-gray-50/50">
                                <th class="px-8 py-5">Siswa</th>
                                <th class="px-8 py-5">Pelanggaran</th>
                                <th class="px-8 py-5">Point</th>
                                <th class="px-8 py-5">Status Admin</th>
                                <th class="px-8 py-5">Tanggal</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($violations as $violation)
                            <tr wire:key="violation-{{ $violation->id }}" wire:click="openDetailModal({{ $violation->id }})"
                                class="hover:bg-gray-50/80 cursor-pointer transition-all group">
                                
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-xs transition-all group-hover:bg-teal-500 group-hover:text-white">
                                            {{ strtoupper(substr($violation->student->name, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-700 group-hover:text-teal-600 transition-colors">{{ $violation->student->name }}</span>
                                            <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $violation->student->nis }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-slate-600 text-sm font-medium">{{ $violation->rule->name }}</span>
                                        <span class="text-[10px] text-gray-400 italic">Level: {{ $violation->rule->level }}</span>
                                    </div>
                                </td>

                                <td class="px-8 py-5">
                                    <span class="font-mono font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-lg text-xs border border-rose-100">
                                        -{{ $violation->rule->point }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border
                                        {{ $violation->status == 'diverifikasi' || $violation->status == 'approved'
                                            ? 'bg-emerald-50 text-emerald-600 border-emerald-100' 
                                            : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                                        {{ $violation->status }}
                                    </span>
                                </td>

                                <td class="px-8 py-5 text-sm text-gray-500">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-slate-600">{{ $violation->created_at->format('d M Y') }}</span>
                                        <span class="text-xs text-gray-400">{{ $violation->created_at->format('H:i') }} WIB</span>
                                    </div>
                                </td>

                                <td class="px-8 py-5 text-center flex items-center justify-center gap-2" @click.stop>
                                    {{-- Edit Trigger (Hanya jika status pending & < 24 Jam) --}}
                                    @if($violation->status === 'pending' && $violation->created_at->diffInHours(now()) < 24)
                                    <button wire:click="edit({{ $violation->id }})" class="p-2.5 text-blue-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="delete({{ $violation->id }})" class="p-2.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    @else
                                    <div class="p-2.5 text-gray-300 cursor-not-allowed" title="Sudah diverifikasi admin atau melebihi 24 jam">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-20 text-gray-400 italic">Belum ada data pelanggaran yang Anda laporkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-8 border-t border-gray-50">
                    {{ $violations->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div x-data="{ show: @entangle('isOpenModal').live }" x-show="show" x-cloak
        class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6">
        
        <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" @click="show = false; $wire.closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] w-full max-w-4xl overflow-hidden relative shadow-[0_32px_64px_-15px_rgba(0,0,0,0.3)] border border-white/20" @click.stop>
            @if($selectedViolation)
            <div class="flex flex-col lg:flex-row h-full max-h-[90vh]">
                
                {{-- Left side: Evidence --}}
                <div class="lg:w-1/2 bg-slate-900 flex items-center justify-center overflow-hidden border-b lg:border-b-0 lg:border-r border-gray-100 relative group/img">
                    @if($selectedViolation->evidence)
                        <img src="{{ asset('storage/' . $selectedViolation->evidence) }}" class="w-full h-full object-contain">
                    @else
                        <div class="flex flex-col items-center gap-4 text-gray-500 p-20 text-center">
                            <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center shadow-sm">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Tidak ada bukti foto</p>
                        </div>
                    @endif

                    <div class="absolute top-6 left-6 z-20">
                        <div class="bg-rose-500 text-white px-4 py-2 rounded-2xl font-black text-sm shadow-xl">
                            -{{ $selectedViolation->rule->point }} POINT
                        </div>
                    </div>
                </div>

                {{-- Right side: Details --}}
                <div class="lg:w-1/2 p-8 lg:p-12 overflow-y-auto relative">
                    <button @click="show = false; $wire.closeModal()" class="absolute top-8 right-8 p-3 rounded-2xl hover:bg-rose-50 text-gray-400 hover:text-rose-500 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div class="mb-6">
                        <span class="px-4 py-1.5 bg-teal-50 text-teal-600 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-teal-100">
                            Detail Laporan Anda
                        </span>
                    </div>

                    <div class="space-y-6 text-slate-700">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Nama Siswa</p>
                            <h3 class="text-xl font-black text-slate-800">{{ $selectedViolation->student->name }}</h3>
                            <p class="text-xs text-gray-500 uppercase">NIS: {{ $selectedViolation->student->nis }}</p>
                        </div>

                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Aturan Yang Dilanggar</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $selectedViolation->rule->name }}</p>
                            <p class="text-xs text-gray-400">Kategori Tingkat: {{ $selectedViolation->rule->level }}</p>
                        </div>

                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Catatan Kronologi</p>
                            <p class="text-sm bg-gray-50 p-4 rounded-xl border border-gray-100 italic">
                                "{{ $selectedViolation->notes ?? 'Tidak ada catatan tambahan.' }}"
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-t pt-4 text-xs">
                            <div>
                                <p class="text-gray-400 font-medium">Status Verifikasi</p>
                                <span class="font-bold uppercase text-teal-600">{{ $selectedViolation->status }}</span>
                            </div>
                            <div>
                                <p class="text-gray-400 font-medium">Diverifikasi Oleh</p>
                                <span class="font-bold text-slate-700">{{ $selectedViolation->verifier->name ?? 'Belum Diverifikasi' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div>
    </div>

</div>