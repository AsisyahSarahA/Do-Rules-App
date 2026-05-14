<div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-1">
                Manajemen Orang Tua
            </h2>

            <p class="text-sm text-gray-500 font-medium">
                Kelola data wali murid, kontak WhatsApp, dan informasi alamat domisili.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button wire:click="$toggle('showForm')"
                class="bg-teal-500 hover:bg-teal-800 text-white text-sm font-semibold px-6 py-2.5 rounded-full flex items-center gap-2 transition-all shadow-md active:scale-95">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $showForm ? 'M20 12H4' : 'M12 4v16m8-8H4' }}">
                    </path>
                </svg>

                {{ $showForm ? 'Tutup Form' : 'Tambah Orang Tua' }}
            </button>
        </div>
    </div>

    {{-- Replaced with global toast --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- FORM --}}
        @if ($showForm)
            <div class="lg:col-span-4 animate-in fade-in slide-in-from-left-4 duration-300">

                <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm sticky top-8">

                    <h3 class="text-lg font-bold text-slate-800 mb-6">
                        {{ $isEdit ? 'Update Data Wali' : 'Input Wali Baru' }}
                    </h3>

                    <form wire:submit.prevent="save" class="space-y-5">

                        {{-- NAMA --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">
                                Nama Lengkap
                            </label>

                            <input wire:model="name"
                                type="text"
                                placeholder="Misal: Bapak Heru Sulistyo"
                                class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
                            @error('name') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- PHONE --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">
                                No. WhatsApp
                            </label>

                            <input wire:model="phone"
                                type="text"
                                placeholder="Misal: 0812xxxx"
                                class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
                            @error('phone') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">
                                Email
                            </label>

                            <input wire:model="email"
                                type="email"
                                placeholder="wali@email.com"
                                class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
                            @error('email') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- ADDRESS --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">
                                Alamat Lengkap
                            </label>

                            <textarea wire:model="address"
                                placeholder="Masukkan alamat domisili..."
                                rows="3"
                                class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all resize-none"></textarea>
                            @error('address') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="pt-2">
                            <button type="submit"
                                wire:loading.attr="disabled"
                                class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-teal-500/20 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                                <span wire:loading.remove wire:target="save">{{ $isEdit ? 'Update' : 'Simpan' }}</span>
                                <span wire:loading wire:target="save" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endif

        {{-- TABLE --}}
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }} transition-all duration-300">

            <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm overflow-hidden">

                {{-- SEARCH --}}
                <div
                    class="p-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">

                    <div class="relative w-full sm:w-64">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                </path>
                            </svg>
                        </span>

                        <input wire:model.live="search"
                            type="text"
                            placeholder="Cari orang tua..."
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-full text-sm focus:ring-2 focus:ring-teal-900/10">
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead>
                            <tr
                                class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">

                                <th class="px-8 py-5">Orang Tua</th>
                                <th class="px-8 py-5">Kontak</th>
                                <th class="px-8 py-5">Alamat</th>
                                <th class="px-8 py-5">Siswa</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">

                            @forelse($parents as $parent)

                                <tr class="group hover:bg-gray-50/50 transition-all">

                                    {{-- ORANG TUA --}}
                                    <td class="px-8 py-5">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-xs transition-transform group-hover:scale-110">

                                                {{ strtoupper(substr($parent->name, 0, 1)) }}
                                            </div>

                                            <div class="flex flex-col">

                                                <span
                                                    class="font-bold text-slate-700 leading-tight group-hover:text-teal-600 transition-colors">

                                                    {{ $parent->name }}
                                                </span>

                                                <span
                                                    class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider font-semibold">
                                                    Wali Murid
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- KONTAK --}}
                                    <td class="px-8 py-5 text-sm text-gray-600 font-medium">

                                        <div class="flex flex-col">

                                            <span class="text-xs font-bold text-slate-700">
                                                {{ $parent->phone }}
                                            </span>

                                            <span class="text-[10px] text-gray-400">
                                                {{ $parent->email ?? '-' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- ALAMAT --}}
                                    <td class="px-8 py-5">

                                        <span
                                            class="text-xs text-gray-500 leading-relaxed block max-w-[200px] truncate"
                                            title="{{ $parent->address }}">

                                            {{ $parent->address }}
                                        </span>
                                    </td>

                                    {{-- SISWA --}}
                                    <td class="px-8 py-5">

                                        <div class="flex flex-col gap-2">

                                            @forelse($parent->students as $student)

                                                <span
                                                    class="text-xs bg-teal-50 text-teal-600 px-3 py-1 rounded-full w-fit font-semibold">

                                                    {{ $student->name }}
                                                </span>

                                            @empty

                                                <span class="text-xs text-gray-400 italic">
                                                    Belum ada siswa
                                                </span>

                                            @endforelse

                                        </div>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-8 py-5 text-center">

                                        <div
                                            class="flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">

                                            {{-- EDIT --}}
                                            <button wire:click="edit({{ $parent->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                                title="Edit Data">

                                                <svg class="w-5 h-5" fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M18.364 5.364a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.364-9.364z">
                                                    </path>
                                                </svg>
                                            </button>

                                            {{-- DELETE --}}
                                            <button
                                                wire:click="delete({{ $parent->id }})"
                                                class="p-2 text-rose-400 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Hapus Data">

                                                <svg class="w-5 h-5" fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="px-8 py-20 text-center text-gray-400 italic">

                                        Belum ada data orang tua.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="p-8 border-t border-gray-50 bg-gray-50/30">
                    {{ $parents->links() }}
                </div>

            </div>
        </div>
    </div>
</div>