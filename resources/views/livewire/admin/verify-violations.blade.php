<div>
    <div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

        {{-- FLASH MESSAGE ERROR SYSTEM --}}
        @if (session()->has('error'))
            <div class="mb-5 bg-red-100 text-red-700 px-4 py-3 rounded-xl border border-red-200 text-sm font-medium animate-bounce">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- FLASH MESSAGE SUCCESS --}}
        @if (session()->has('message'))
            <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-xl border border-green-200 text-sm font-medium">
                ✨ {{ session('message') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-1">Verifikasi Pelanggaran</h2>
                <p class="text-sm text-gray-500 font-medium">Validasi laporan pelanggaran siswa sebelum diproses lebih lanjut.</p>
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm overflow-hidden">
            
            {{-- SEARCH & FILTERS --}}
            <div class="p-6 border-b border-gray-50 flex flex-col xl:flex-row justify-between items-stretch xl:items-center gap-4 bg-white">
                <div class="relative w-full xl:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-sm">🔍</span>
                    <input wire:model.live.debounce.500ms="search" type="text" placeholder="Cari nama atau NIS siswa..."
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-full text-sm focus:ring-2 focus:ring-teal-900/10 placeholder-gray-400">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full xl:w-auto">
                    <select wire:model.live="filterLevel" class="w-full px-4 py-2.5 bg-gray-50 border-none rounded-full text-sm text-gray-600 font-medium">
                        <option value="">All Levels (Semua)</option>
                        <option value="ringan">🟢 Ringan</option>
                        <option value="sedang">🟡 Sedang</option>
                        <option value="berat">🔴 Berat</option>
                    </select>

                    <select wire:model.live="filterStatus" class="w-full px-4 py-2.5 bg-gray-50 border-none rounded-full text-sm text-gray-600 font-medium">
                        <option value="">All Status (Semua)</option>
                        <option value="pending">⏳ Pending</option>
                        <option value="diverifikasi">✅ Diverifikasi</option>
                        <option value="ditolak">❌ Ditolak</option>
                    </select>

                    <select wire:model.live="filterRule" class="w-full px-4 py-2.5 bg-gray-50 border-none rounded-full text-sm text-gray-600 font-medium truncate">
                        <option value="">All Rules (Semua Aturan)</option>
                        @foreach ($rules ?? [] as $rule)
                            <option value="{{ $rule->id }}">{{ $rule->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- TABLE CONTENT --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                            <th class="px-8 py-5">Siswa</th>
                            <th class="px-8 py-5">Pelanggaran</th>
                            <th class="px-8 py-5">Level</th>
                            <th class="px-8 py-5">Point</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($violations as $v)
                            @php
                                // Ekstrak string murni dari objek Enum status secara aman
                                $rawStatus = is_object($v->status) ? ($v->status->value ?? $v->status->name) : $v->status;
                                $currentStatus = strtolower($rawStatus);
                            @endphp
                            <tr wire:key="violation-{{ $v->id }}" class="group hover:bg-gray-50/30 transition-all">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-sm uppercase shrink-0">
                                            {{ substr($v->student->name ?? 'NN', 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-700 group-hover:text-teal-600 transition-colors">{{ $v->student->name }}</div>
                                            <div class="text-xs text-gray-400 font-medium mt-0.5">NIS: {{ $v->student->nis ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-600 max-w-xs truncate font-semibold text-slate-700">
                                    {{ $v->rule->name ?? 'Aturan Terhapus' }}
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold inline-block
                                    @if (($v->rule->level ?? '') == 'ringan') bg-green-50 text-green-600
                                    @elseif(($v->rule->level ?? '') == 'sedang') bg-yellow-50 text-yellow-600
                                    @else bg-red-50 text-red-600 @endif">
                                        {{ ucfirst($v->rule->level ?? 'Asing') }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold">+{{ $v->rule->point ?? 0 }}</span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold inline-block
                                    @if ($currentStatus == 'pending') bg-orange-50 text-orange-600
                                    @elseif($currentStatus == 'diverifikasi' || $currentStatus == 'verified') bg-emerald-50 text-emerald-600
                                    @else bg-rose-50 text-rose-600 @endif">
                                       {{ $currentStatus === 'verified' ? 'Diverifikasi' : ($currentStatus === 'rejected' ? 'Ditolak' : ucfirst($currentStatus)) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <button wire:click="openDetailModal({{ $v->id }})" class="bg-slate-100 hover:bg-teal-500 hover:text-white text-slate-600 text-xs font-bold px-4 py-2 rounded-full transition-all active:scale-95 shadow-sm">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center text-gray-400 italic text-sm">🍃 Tidak ada data pelanggaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($violations, 'links'))
                <div class="p-6 bg-gray-50/50 border-t border-gray-50">{{ $violations->links() }}</div>
            @endif
        </div>
    </div>

    {{-- ================= MODAL DETAIL LAPORAN ================= --}}
    @if ($isOpenModal && $this->selectedViolation)
        @php
            $modalRawStatus = is_object($this->selectedViolation->status) ? ($this->selectedViolation->status->value ?? $this->selectedViolation->status->name) : $this->selectedViolation->status;
            $modalStatus = strtolower($modalRawStatus);
        @endphp
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" wire:click="closeModal"></div>

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl max-w-xl w-full z-10 border border-gray-100 transform transition-all">
                <div class="px-8 pt-8 pb-4 flex justify-between items-start">
                    <div>
                        <span class="text-[10px] font-bold text-teal-600 uppercase tracking-widest bg-teal-50 px-2.5 py-1 rounded-md">Detail Laporan #{{ $this->selectedViolation->id }}</span>
                        <h3 class="text-xl font-bold text-slate-800 mt-2">Validasi Laporan</h3>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 p-2 rounded-full">✕</button>
                </div>

                <div class="px-8 py-4 space-y-5 max-h-[70vh] overflow-y-auto text-sm text-gray-600">
                    <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-100/50 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-gray-400 block font-medium">Siswa Terlaporkan</span>
                            <span class="font-bold text-slate-700 block mt-0.5">{{ $this->selectedViolation->student->name }}</span>
                            <span class="text-xs text-gray-400">NIS: {{ $this->selectedViolation->student->nis }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block font-medium">Jenis Pelanggaran</span>
                            <span class="font-bold text-slate-700 block mt-0.5">{{ $this->selectedViolation->rule->name }}</span>
                            <span class="text-xs text-amber-600 font-semibold">⚡ +{{ $this->selectedViolation->rule->point }} Point</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 px-1">
                        <div>
                            <span class="text-xs text-gray-400 block font-medium">Dilaporkan Oleh</span>
                            <span class="font-semibold text-slate-700 block mt-0.5">{{ $this->selectedViolation->reporter->name ?? 'Guru / Staff' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block font-medium">Waktu Laporan</span>
                            <span class="font-semibold text-slate-700 block mt-0.5">{{ $this->selectedViolation->created_at?->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <span class="text-xs text-gray-400 block font-medium mb-1.5">Catatan Kronologi:</span>
                        <div class="bg-gray-50 p-4 rounded-2xl text-slate-700 border border-gray-100/50 italic">
                            "{{ $this->selectedViolation->notes ?? 'Tidak ada catatan tambahan.' }}"
                        </div>
                    </div>

                    <div>
                        <span class="text-xs text-gray-400 block font-medium mb-2">Bukti Pendukung:</span>
                        @if ($this->selectedViolation->evidence)
                            <div class="relative rounded-2xl overflow-hidden border border-gray-100 bg-black max-h-48 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $this->selectedViolation->evidence) }}" alt="Evidence" class="object-contain max-h-48 w-full">
                            </div>
                        @else
                            <div class="p-4 rounded-2xl border-2 border-dashed border-gray-100 text-center text-xs text-gray-400">📷 Tidak ada bukti foto.</div>
                        @endif
                    </div>
                </div>

                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-50 flex items-center justify-end gap-3">
                    <button wire:click="closeModal" class="px-5 py-2.5 rounded-full text-xs font-bold text-gray-500 hover:bg-gray-100">Kembali</button>

                    @if ($modalStatus === 'pending')
                        <button wire:click="reject({{ $this->selectedViolation->id }})" wire:confirm="Yakin ingin MENOLAK laporan ini?"
                            class="px-5 py-2.5 rounded-full bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold shadow-md transition-all active:scale-95">
                            ✕ Tolak Laporan
                        </button>

                        <button wire:click="verify({{ $this->selectedViolation->id }})" wire:confirm="Yakin laporan ini VALID?"
                            class="px-6 py-2.5 rounded-full bg-teal-500 hover:bg-teal-600 text-white text-xs font-bold shadow-md transition-all active:scale-95">
                            ✓ Verifikasi Laporan
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>