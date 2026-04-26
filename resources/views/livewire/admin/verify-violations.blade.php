<div>
    <div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-1">
                    Verifikasi Pelanggaran
                </h2>
                <p class="text-sm text-gray-500 font-medium">
                    Validasi laporan pelanggaran siswa sebelum diproses lebih lanjut.
                </p>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm overflow-hidden">

            {{-- SEARCH --}}
            <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        🔍
                    </span>
                    <input wire:model.live="search" type="text" placeholder="Cari siswa..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-full text-sm focus:ring-2 focus:ring-emerald-900/10">
                </div>
            </div>

            {{-- TABLE CONTENT --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                            <th class="px-8 py-5">Siswa</th>
                            <th class="px-8 py-5">Pelanggaran</th>
                            <th class="px-8 py-5">Level</th>
                            <th class="px-8 py-5">Point</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse($violations as $v)
                            <tr wire:key="violation-{{ $v->id }}"
                                class="group hover:bg-gray-50/50 transition-all">

                                {{-- SISWA --}}
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                                            {{ substr($v->student->nis, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-700">
                                                {{ $v->student->nis }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                ID: {{ $v->student->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- PELANGGARAN --}}
                                <td class="px-8 py-5 text-sm text-gray-600">
                                    <span class="font-semibold text-slate-700">
                                        {{ $v->rule->name }}
                                    </span>
                                </td>

                                {{-- LEVEL --}}
                                <td class="px-8 py-5">
                                    <span
                                        class="
                                px-3 py-1 rounded-full text-xs font-bold
                                @if ($v->rule->level == 'ringan') bg-green-50 text-green-600
                                @elseif($v->rule->level == 'sedang') bg-yellow-50 text-yellow-600
                                @else bg-red-50 text-red-600 @endif
                            ">
                                        {{ ucfirst($v->rule->level) }}
                                    </span>
                                </td>

                                {{-- POINT --}}
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold">
                                        +{{ $v->rule->point }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td class="px-8 py-5 text-center">
                                    <button wire:click="verify({{ $v->id }})"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-md transition-all active:scale-95">
                                        Verifikasi
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-gray-400 italic">
                                    Tidak ada pelanggaran yang perlu diverifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
