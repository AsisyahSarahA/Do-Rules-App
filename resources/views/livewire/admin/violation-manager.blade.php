<div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">

        <div>
            <h2 class="text-3xl font-black text-slate-800">
                Data Pelanggaran
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola laporan pelanggaran siswa
            </p>
        </div>

        <button wire:click="{{ $showForm ? 'resetForm' : '$set(\'showForm\', true)' }}"
            class="{{ $showForm ? 'bg-slate-200 text-slate-600' : 'bg-teal-500 text-white' }} px-6 py-3 rounded-2xl font-bold shadow-lg transition-all">
            {{ $showForm ? 'Tutup Form' : '+ Tambah Pelanggaran' }}
        </button>

    </div>

    {{-- Replaced with global toast --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- FORM --}}
        @if($showForm)

        <div class="lg:col-span-4">

            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">

                <h3 class="text-xl font-black text-slate-800 mb-8">
                    {{ $isEdit ? 'Edit Pelanggaran' : 'Input Pelanggaran' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-5">

                    {{-- siswa --}}
                    <div>

                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                            Siswa
                        </label>

                        <select wire:model="student_id" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4">
                            <option value="">Pilih siswa</option>

                            @foreach($students as $student)

                            <option value="{{ $student->id }}">
                                {{ $student->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- rule --}}
                    <div>

                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                            Peraturan
                        </label>

                        <select wire:model="rule_id" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4">
                            <option value="">Pilih peraturan</option>

                            @foreach($rules as $rule)

                            <option value="{{ $rule->id }}">
                                {{ $rule->name }} ({{ $rule->point }} Point)
                            </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- notes --}}
                    <div>

                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                            Catatan
                        </label>

                        <textarea wire:model="notes" rows="4"
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4"></textarea>

                    </div>

                    {{-- upload --}}
                    <div>

                        <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                            Bukti Foto
                        </label>

                        <input type="file" wire:model="evidence" accept="image/*" capture="environment"
                            x-on:change="if($event.target.files[0] && $event.target.files[0].size > 2 * 1024 * 1024) { alert('⚠️ Ukuran file terlalu besar! Maksimal 2MB.'); }"
                            class="w-full bg-gray-50 rounded-2xl px-5 py-4">

                        @error('evidence')
                        <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase tracking-widest">{{ $message }}</p>
                        @enderror

                        @if($evidence)

                        <img src="{{ $evidence->temporaryUrl() }}" class="mt-4 rounded-2xl w-full h-52 object-cover">

                        @endif

                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full bg-teal-500 hover:bg-teal-600 text-white py-4 rounded-2xl font-bold transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="save">{{ $isEdit ? 'Update Pelanggaran' : 'Simpan Pelanggaran' }}</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>

                        @if($isEdit)
                        <button type="button" wire:click="resetForm"
                            class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 py-4 rounded-2xl font-bold transition-all">
                            Batal Edit
                        </button>
                        @endif
                    </div>

                </form>

            </div>

        </div>

        @endif

        {{-- TABLE --}}
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }}">

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">

                {{-- FILTERS --}}
                <div class="p-6 border-b border-gray-100 flex flex-wrap items-center gap-4 bg-gray-50/50">

                    <div class="flex-1 min-w-[200px]">
                        <input type="text" wire:model.live="search" placeholder="Cari siswa..."
                            class="w-full bg-white border-gray-200 rounded-2xl px-5 py-2.5 focus:ring-2 focus:ring-teal-500/20 text-sm">
                    </div>

                    <div class="flex flex-wrap items-center gap-3">

                        <input type="date" wire:model.live="filterDay"
                            class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20"
                            placeholder="Hari">

                        <select wire:model.live="filterMonth"
                            class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Semua Bulan</option>
                            @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="filterYear"
                            class="bg-white border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-teal-500/20">
                            <option value="">Semua Tahun</option>
                            @foreach(range(date('Y') - 2, date('Y')) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="text-left text-[11px] uppercase tracking-[0.2em] text-gray-400 bg-gray-50/50">

                                <th class="px-8 py-5">Siswa</th>
                                <th class="px-8 py-5">Pelanggaran</th>
                                <th class="px-8 py-5">Point</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5">Tanggal</th>
                                <th class="px-8 py-5 text-center">Aksi</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-50">

                            @forelse($violations as $violation)

                            <tr wire:key="violation-{{ $violation->id }}" wire:click="showDetail({{ $violation->id }})"
                                class="hover:bg-gray-50 cursor-pointer transition-all group border-b border-gray-50 last:border-0">

                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-xs transition-all group-hover:bg-teal-500 group-hover:text-white">
                                            {{ strtoupper(substr($violation->student->name, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-700 group-hover:text-teal-600 transition-colors">{{
                                                $violation->student->name }}</span>
                                            <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{
                                                $violation->student->nis }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-slate-600 text-sm font-medium">{{ $violation->rule->name
                                            }}</span>
                                        <span class="text-[10px] text-gray-400 italic">Level: {{ $violation->rule->level
                                            }}</span>
                                    </div>
                                </td>

                                <td class="px-8 py-5">
                                    <span
                                        class="font-mono font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-lg text-xs border border-rose-100">
                                        -{{ $violation->rule->point }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">

                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                            {{ $violation->status == 'approved'
                                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-100'
                                                : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                        {{ $violation->status }}
                                    </span>

                                </td>

                                <td class="px-8 py-5 text-sm text-gray-500">

                                    <div class="flex flex-col">

                                        <span class="font-medium text-slate-600">
                                            {{ $violation->created_at->format('d M Y') }}
                                        </span>

                                        <span class="text-xs text-gray-400">
                                            {{ $violation->created_at->format('H:i') }} WIB
                                        </span>

                                    </div>

                                </td>

                                <td class="px-8 py-5 text-center flex items-center justify-center gap-2">

                                    {{-- Edit Button (Only if within 24 hours) --}}
                                    @if($violation->created_at->diffInHours(now()) < 24)
                                    <button wire:click.stop="edit({{ $violation->id }})"
                                        class="p-2.5 text-blue-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all"
                                        title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    @else
                                    <div class="p-2.5 text-gray-300 cursor-not-allowed" title="Sudah lewat 24 jam (Tidak bisa edit)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    @endif

                                    <button wire:click.stop="delete({{ $violation->id }})"
                                        class="p-2.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all"
                                        title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="text-center py-20 text-gray-400 italic">
                                    Belum ada data pelanggaran
                                </td>

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
    <div x-data="{ show: @entangle('showDetailModal').live }" x-show="show" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6">
        <!-- Backdrop -->
        <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" @click="show = false; $wire.closeModal()"></div>

        <!-- Modal Content -->
        <div class="bg-white rounded-[2.5rem] w-full max-w-4xl overflow-hidden relative shadow-[0_32px_64px_-15px_rgba(0,0,0,0.3)] border border-white/20"
            @click.stop>

            @if($selectedViolation)

            <div class="flex flex-col lg:flex-row h-full max-h-[90vh]">

                {{-- Left side: Evidence --}}
                <div
                    class="lg:w-1/2 bg-slate-900 flex items-center justify-center overflow-hidden border-b lg:border-b-0 lg:border-r border-gray-100 relative group/img">

                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover/img:opacity-100 transition-opacity z-10">
                    </div>

                    @if($selectedViolation->evidence)
                    <img src="{{ asset('storage/' . $selectedViolation->evidence) }}"
                        class="w-full h-full object-contain relative z-0">
                    @else
                    <div class="flex flex-col items-center gap-4 text-gray-500 p-20 text-center">
                        <div class="w-24 h-24 rounded-full bg-white/10 flex items-center justify-center shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Bukti Foto Kosong</p>
                    </div>
                    @endif

                    {{-- Floating Point Badge --}}
                    <div class="absolute top-6 left-6 z-20">
                        <div
                            class="bg-rose-500 text-white px-4 py-2 rounded-2xl font-black text-sm shadow-xl shadow-rose-500/30">
                            -{{ $selectedViolation->rule->point }} POINT
                        </div>
                    </div>

                </div>

                {{-- Right side: Details --}}
                <div class="lg:w-1/2 p-8 lg:p-12 overflow-y-auto custom-scrollbar relative">

                    <button @click="show = false; $wire.closeModal()"
                        class="absolute top-8 right-8 p-3 rounded-2xl hover:bg-rose-50 text-gray-400 hover:text-rose-500 transition-all z-10 group">
                        <svg class="w-6 h-6 transition-transform group-hover:rotate-90" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div class="mb-10">
                        <span
                            class="px-4 py-1.5 bg-teal-50 text-teal-600 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-teal-100">
                            Case Log Details
                        </span>
                    </div>

                    <div class="space-y-10">

                        {{-- Student --}}
                        <div class="flex items-start gap-5">
                            <div
                                class="w-14 h-14 rounded-3xl bg-teal-500/10 flex-shrink-0 flex items-center justify-center text-teal-600 border border-teal-500/20 shadow-sm">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Target
                                    Siswa</p>
                                <h3 class="text-2xl font-black text-slate-800 leading-tight">{{
                                    $selectedViolation->student->name }}</h3>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="text-xs font-bold text-slate-400">{{ $selectedViolation->student->nis
                                        }}</span>
                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                    <span class="text-xs font-bold text-teal-600 uppercase">{{
                                        $selectedViolation->student->classRoom->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Rule --}}
                        <div class="flex items-start gap-5">
                            <div
                                class="w-14 h-14 rounded-3xl bg-rose-500/10 flex-shrink-0 flex items-center justify-center text-rose-600 border border-rose-500/20 shadow-sm">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">
                                    Klasifikasi Pelanggaran</p>
                                <h3 class="text-xl font-bold text-slate-800 leading-snug">{{
                                    $selectedViolation->rule->name }}</h3>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2 italic">"{{
                                    $selectedViolation->rule->description }}"</p>
                            </div>
                        </div>

                        {{-- Metadata --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-[1.5rem] p-5 border border-gray-100">
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-2">Dilaporkan
                                    Oleh</p>
                                <p class="font-black text-slate-700 text-xs">{{ $selectedViolation->reporter->name ??
                                    '-' }}</p>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase">{{
                                    $selectedViolation->reporter->role ?? 'Staff' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-[1.5rem] p-5 border border-gray-100">
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-2">Timestamp
                                </p>
                                <p class="font-black text-slate-700 text-xs">{{
                                    $selectedViolation->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase">{{
                                    $selectedViolation->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        {{-- Notes --}}
                        @if($selectedViolation->notes)
                        <div class="relative">
                            <div class="absolute -left-2 top-0 bottom-0 w-1 bg-amber-200 rounded-full"></div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2 ml-2">Kronologi
                                Kejadian</p>
                            <p class="text-sm text-slate-600 leading-relaxed ml-2 font-medium">
                                {{ $selectedViolation->notes }}
                            </p>
                        </div>
                        @endif

                    </div>

                    <div class="mt-12 pt-10 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-3 h-3 rounded-full animate-pulse {{ $selectedViolation->status == 'approved' ? 'bg-emerald-500' : 'bg-amber-500' }}">
                            </div>
                            <div class="flex flex-col">
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Verification
                                    Status</p>
                                <p
                                    class="text-sm font-black uppercase tracking-tighter {{ $selectedViolation->status == 'approved' ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ $selectedViolation->status == 'approved' ? 'Authenticated' : 'Pending Review' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>
