<div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-1">Manajemen Peraturan</h2>
            <p class="text-sm text-gray-500 font-medium">Kelola daftar peraturan, poin sanksi, dan tingkat pelanggaran.</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="$toggle('showForm')" 
                class="bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-6 py-2.5 rounded-full flex items-center gap-2 transition-all shadow-md active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $showForm ? 'M20 12H4' : 'M12 4v16m8-8H4' }}"></path>
                </svg>
                {{ $showForm ? 'Tutup Form' : 'Tambah Peraturan' }}
            </button>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Form Section -->
        @if($showForm)
        <div class="lg:col-span-4 animate-in fade-in slide-in-from-left-4 duration-300">
            <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm sticky top-8">
                <h3 class="text-lg font-bold text-slate-800 mb-6">{{ $isEdit ? 'Update Peraturan' : 'Input Peraturan Baru' }}</h3>
                
                <form wire:submit.prevent="save" class="space-y-5">
                    
                    <!-- Nama Peraturan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Deskripsi Peraturan</label>
                        <textarea wire:model="name" rows="3" placeholder="Misal: Membolos saat jam pelajaran berlangsung" 
                            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-emerald-900/10 rounded-2xl text-sm transition-all resize-none"></textarea>
                        @error('name') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Poin -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Bobot Poin</label>
                        <input wire:model="point" type="number" placeholder="Misal: 10" 
                            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-emerald-900/10 rounded-2xl text-sm transition-all">
                        @error('point') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Tingkat Pelanggaran</label>
                        <select wire:model="level" 
                            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-emerald-900/10 rounded-2xl text-sm transition-all appearance-none cursor-pointer">
                            <option value="">Pilih Level...</option>
                            <option value="ringan">Ringan (Hijau)</option>
                            <option value="sedang">Sedang (Kuning)</option>
                            <option value="berat">Berat (Merah)</option>
                        </select>
                        @error('level') <span class="text-xs text-rose-500 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2 flex gap-3">
                        @if($isEdit)
                            <button type="button" wire:click="resetForm" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-2xl transition-all">
                                Batal
                            </button>
                        @endif
                        <button type="submit" 
                            class="flex-[2] bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-emerald-500/20">
                            {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Data' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Table Section -->
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }} transition-all duration-300">
            <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm overflow-hidden">
                
                <!-- Search Bar -->
                <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input wire:model.live="search" type="text" placeholder="Cari peraturan..." 
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-full text-sm focus:ring-2 focus:ring-emerald-900/10 transition-all">
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                                <th class="px-8 py-5">Peraturan</th>
                                <th class="px-8 py-5 text-center">Bobot Poin</th>
                                <th class="px-8 py-5 text-center">Tingkat</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($rules as $rule)
                            <tr class="group hover:bg-gray-50/50 transition-all">
                                <td class="px-8 py-5 max-w-sm">
                                    <div class="flex flex-col gap-1">
                                        <span class="font-bold text-slate-700 leading-snug">{{ $rule->name }}</span>
                                        <span class="text-[10px] text-gray-400">ID: {{ $rule->id }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-8 py-5 text-center">
                                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-700 font-bold shadow-inner">
                                        {{ $rule->point }}
                                    </div>
                                </td>
                                
                                <td class="px-8 py-5 text-center">
                                    <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wide
                                        @if($rule->level === 'ringan') bg-emerald-50 text-emerald-600 border border-emerald-100
                                        @elseif($rule->level === 'sedang') bg-amber-50 text-amber-600 border border-amber-100
                                        @elseif($rule->level === 'berat') bg-rose-50 text-rose-600 border border-rose-100
                                        @endif
                                    ">
                                        {{ ucfirst($rule->level) }}
                                    </span>
                                </td>
                                
                                <td class="px-8 py-5 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button wire:click="edit({{ $rule->id }})" class="p-2 text-blue-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M18.364 5.364a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.364-9.364z"></path></svg>
                                        </button>
                                        <button onclick="confirm('Apakah Anda yakin ingin menghapus peraturan ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $rule->id }})" class="p-2 text-rose-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center text-gray-400 italic">Belum ada data peraturan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($rules->hasPages())
                <div class="p-6 bg-gray-50/50 border-t border-gray-50">
                    {{ $rules->links() }}
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
