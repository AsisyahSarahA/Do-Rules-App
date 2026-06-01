<div class="p-6 max-w-7xl mx-auto space-y-6 bg-slate-50 min-h-screen">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-200 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Kelas saya</h1>
            <p class="text-sm text-slate-500 mt-1">
                Memantau perkembangan poin dan rekam jejak pelanggaran siswa di kelas <span
                    class="font-semibold text-teal-600">{{ $classroom->name }}</span>
            </p>
        </div>
        <div
            class="mt-4 md:mt-0 px-4 py-2 bg-teal-50 border border-teal-100 rounded-lg text-sm text-teal-700 font-medium">
            Wali Kelas: {{ auth()->user()->name }} 🧑‍🏫
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">

                <div class="mb-4">
                    <div class="relative rounded-md shadow-sm max-w-md">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text"
                            class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-slate-900 placeholder-slate-400"
                            placeholder="Cari nama siswa...">
                    </div>
                </div>

                <div class="overflow-x-auto rounded-lg border border-slate-100">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-slate-600 font-medium">
                            <tr>
                                <th class="px-4 py-3 text-left">NISN</th>
                                <th class="px-4 py-3 text-left">Nama Siswa</th>
                                <th class="px-4 py-3 text-center">Total Poin</th>
                                <th class="px-4 py-3 text-center">Status Sanksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-slate-700">
                            @forelse($students as $student)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3 font-mono text-xs text-slate-500">{{ $student->nis }}</td>
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ $student->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $student->total_points >= 50 ? 'bg-red-100 text-red-800' : ($student->total_points >= 25 ? 'bg-amber-100 text-amber-800' : 'bg-teal-100 text-teal-800') }}">
                                            {{ $student->total_points ?? 0 }} Poin
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if ($student->total_points >= 50)
                                            <span class="text-xs text-red-600 font-medium">⚠️ Rekomendasi SP (Hubungi
                                                BK)</span>
                                        @elseif($student->total_points >= 20)
                                            <span class="text-xs text-amber-600 font-medium">Tindakan Kesiswaan</span>
                                        @else
                                            <span class="text-xs text-slate-500">Penanganan Wali Kelas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-slate-400">Tidak ada data siswa
                                        ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0114 0z"></path>
                    </svg>
                    Aktivitas Terbaru
                </h2>

                <div class="flow-root">
                    <ul class="-mb-8">
                        @forelse($recentViolations as $index => $violation)
                            <li>
                                <div class="relative pb-8">
                                    @if ($index !== count($recentViolations) - 1)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-slate-200"
                                            aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span
                                                class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white {{ $violation->level === 'berat' ? 'bg-red-500' : ($violation->level === 'sedang' ? 'bg-amber-500' : 'bg-teal-500') }} text-white text-xs font-bold">
                                                !
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0 pt-1.5">
                                            <p class="text-sm font-semibold text-slate-900">
                                                {{ $violation->student->nis }}
                                            </p>
                                            <p class="text-sm font-semibold text-slate-900">
                                                {{ $violation->student->name }}
                                            </p>
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                Melanggar: <span
                                                    class="font-medium text-slate-800">{{ $violation->rule->name }}</span>
                                                <span class="font-medium text-red-600">({{ $violation->rule->point }}
                                                    Poin)</span>
                                            </p>
                                            @if ($violation->notes)
                                                <p class="text-xs text-gray-400 italic mt-0.5">Ket:
                                                    "{{ $violation->notes }}"</p>
                                            @endif
                                            <span class="text-[10px] text-slate-400 block mt-1">
                                                {{ $violation->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p class="text-sm text-slate-400 text-center py-4">Belum ada catatan pelanggaran di kelas
                                ini.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
