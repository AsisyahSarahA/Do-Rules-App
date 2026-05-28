<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-donezo-text">Kelola Jadwal Piket</h1>
            <p class="text-sm text-gray-500 mt-1">Atur jadwal piket untuk para guru</p>
        </div>
        <button wire:click="openAddModal" class="px-4 py-2 bg-donezo-primary text-white text-sm font-semibold rounded-lg hover:bg-teal-700 transition-colors flex items-center gap-2 shadow-sm shadow-teal-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Jadwal
        </button>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Guru</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Piket</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($schedules as $index => $schedule)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-donezo-primary font-bold text-xs">
                                        {{ strtoupper(substr($schedule->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $schedule->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium {{ $schedule->duty_date->isToday() ? 'text-donezo-primary' : 'text-gray-600' }}">
                                {{ $schedule->duty_date->format('d M Y') }}
                                @if($schedule->duty_date->isToday())
                                    <span class="ml-2 text-[10px] bg-teal-100 text-teal-700 px-2 py-0.5 rounded-full uppercase tracking-wider">Hari Ini</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click="deleteSchedule({{ $schedule->id }})"
                                    wire:confirm="Yakin ingin menghapus jadwal ini?"
                                    class="p-2 text-gray-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900 mb-1">Belum Ada Jadwal Piket</h3>
                                <p class="text-sm text-gray-500">Silakan tambahkan jadwal piket guru baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    @if($showAddModal)  
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm" x-data @keydown.escape.window="$wire.closeAddModal()">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden" @click.away="$wire.closeAddModal()">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Tambah Jadwal Piket</h3>
                    <button wire:click="closeAddModal" class="text-gray-400 hover:text-gray-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit="addSchedule">
                    <div class="p-6 space-y-4">
                        <!-- Select Guru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Guru</label>
                            <select wire:model="selectedTeacherId" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-donezo-primary focus:ring-1 focus:ring-donezo-primary outline-none transition-all text-sm @error('selectedTeacherId') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                                <option value="">-- Pilih Guru --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedTeacherId')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Piket</label>
                            <input type="date" wire:model="dutyDate" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-donezo-primary focus:ring-1 focus:ring-donezo-primary outline-none transition-all text-sm @error('dutyDate') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('dutyDate')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="button" wire:click="closeAddModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-donezo-primary rounded-lg hover:bg-teal-700 transition-colors flex items-center gap-2">
                            <span wire:loading.remove wire:target="addSchedule">Simpan Jadwal</span>
                            <span wire:loading wire:target="addSchedule">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
