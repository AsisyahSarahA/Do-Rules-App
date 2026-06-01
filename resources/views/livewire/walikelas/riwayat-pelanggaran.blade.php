<div>
    <div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

        {{-- FLASH MESSAGES --}}
        @if (session()->has('error'))
            <div class="mb-5 bg-red-100 text-red-700 px-4 py-3 rounded-xl border border-red-200 text-sm font-medium animate-bounce">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if (session()->has('message'))
            <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-xl border border-green-200 text-sm font-medium">
                ✨ {{ session('message') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-1">Riwayat Laporan Saya</h2>
            <p class="text-sm text-gray-500 font-medium">Daftar pelanggaran siswa yang pernah Anda laporkan ke sistem.</p>
        </div>

        {{-- MAIN CARD --}}
        <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm overflow-hidden">
            
            {{-- SEARCH --}}
            <div class="p-6 border-b border-gray-50 bg-white">
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-sm">🔍</span>
                    <input wire:model.live.debounce.500ms="search" type="text" placeholder="Cari nama atau NIS siswa..."
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-full text-sm focus:ring-2 focus:ring-teal-900/10 placeholder-gray-400">
                </div>
            </div>

            {{-- TABLE CONTENT --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                            <th class="px-8 py-5">Siswa</th>
                            <th class="px-8 py-5">Pelanggaran</th>
                            <th class="px-8 py-5">Point</th>
                            <th class="px-8 py-5 text-center">Status Validasi</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($violations as $v)
                            <tr wire:key="my-violation-{{ $v->id }}" class="group hover:bg-gray-50/30 transition-all">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-sm uppercase shrink-0">
                                            {{ substr($v->student->name ?? 'NN', 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-700">{{ $v->student->name }}</div>
                                            <div class="text-xs text-gray-400 font-medium mt-0.5">Kelas: {{ $v->student->classroom->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm max-w-xs truncate font-semibold text-slate-600">
                                    {{ $v->rule->name ?? 'Aturan Terhapus' }}
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold">+{{ $v->rule->point ?? 0 }}</span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    {{-- ⚡ MEMAKAI ENUM KAMU SINKRON DENGAN STYLE TERBARU --}}
                                    <span class="px-3 py-1 rounded-full text-xs font-bold inline-block border {{ $v->status->color() }}">
                                        {{ $v->status->label() }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    {{-- 🔥 LOGIKA CEK LIMIT DATA 24 JAM --}}
                                    @if($v->created_at->addHours(24)->isFuture())
                                        <button wire:click="openEditModal({{ $v->id }})" class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold px-4 py-2 rounded-full transition-all active:scale-95 shadow-sm">
                                            ✏️ Edit Catatan
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-400 font-medium italic">🔒 Terkunci (>24j)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-gray-400 italic text-sm">🍃 Anda belum pernah menginput data pelanggaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50/50 border-t border-gray-50">
                {{ $violations->links() }}
            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT KHUSUS GURU ================= --}}
    @if ($isOpenEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" wire:click="closeEditModal"></div>

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl max-w-md w-full z-10 border border-gray-100 transform transition-all">
                <div class="px-8 pt-8 pb-4 flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Ubah Catatan Laporan</h3>
                        <p class="text-xs text-gray-400 mt-1">Anda hanya diperbolehkan mengedit catatan kronologi kronis.</p>
                    </div>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600 bg-gray-50 p-2 rounded-full">✕</button>
                </div>

                <form wire:submit.prevent="updateViolation" class="px-8 py-4 space-y-4 text-sm text-gray-600">
                    <div>
                        <label class="text-xs text-gray-400 block font-medium mb-1">Nama Siswa</label>
                        <input type="text" disabled value="{{ $studentName }}" class="w-full bg-gray-100 border-none rounded-xl text-sm text-gray-500 font-semibold px-4 py-2.5">
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 block font-medium mb-1">Pelanggaran</label>
                        <input type="text" disabled value="{{ $ruleName }}" class="w-full bg-gray-100 border-none rounded-xl text-sm text-gray-500 font-semibold px-4 py-2.5">
                    </div>

                    <div>
                        <label class="text-xs text-slate-700 block font-bold mb-1">Catatan Kronologi Baru:</label>
                        <textarea wire:model="notes" rows="4" required class="w-full bg-gray-50 border-gray-200 border rounded-2xl text-sm p-4 text-slate-700 focus:ring-2 focus:ring-teal-500/20 placeholder-gray-400" placeholder="Tulis kronologi kejadian secara detail..."></textarea>
                    </div>

                    <div class="pt-4 pb-2 flex items-center justify-end gap-3">
                        <button type="button" wire:click="closeEditModal" class="px-5 py-2.5 rounded-full text-xs font-bold text-gray-500 hover:bg-gray-100">Batal</button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-md transition-all active:scale-95">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>