<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Verifikasi Laporan Hari Ini</h2>
            <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium">5 Perlu
                Verifikasi</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <p class="text-slate-500 text-sm">Total Laporan</p>
                <p class="text-2xl font-bold text-slate-800">128</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-600 text-sm uppercase">
                    <tr>
                        <th class="p-4 font-semibold">Siswa</th>
                        <th class="p-4 font-semibold">Pelanggaran</th>
                        <th class="p-4 font-semibold">Pelapor</th>
                        <th class="p-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4">
                            <p class="font-medium text-slate-900">Budi Santoso</p>
                            <p class="text-xs text-slate-500">Kelas XI-RPL 1</p>
                        </td>
                        <td class="p-4 text-slate-700 text-sm">Merokok di area kantin</td>
                        <td class="p-4 text-slate-700 text-sm">Pak Ahmad</td>
                        <td class="p-4 text-center">
                            <button
                                class="bg-teal-500 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-teal-600 transition">Approve</button>
                            <button class="text-rose-500 px-4 py-1.5 text-sm font-medium">Tolak</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
