<form wire:submit.prevent="save" class="space-y-5">
    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
        <input wire:model="name" type="text" placeholder="Misal: Ahmad Fauzi"
            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
        @error('name') <span class="text-xs text-rose-500 mt-1 block ml-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email (Untuk Login)</label>
        <input wire:model="email" type="email" placeholder="Misal: echa@siswa.com"
            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
        @error('email') <span class="text-xs text-rose-500 mt-1 block ml-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">NIS</label>
        <input wire:model="nis" type="text" placeholder="Misal: 12345678"
            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all">
        @error('nis') <span class="text-xs text-rose-500 mt-1 block ml-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Kelas</label>
        <select wire:model="class_id"
            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all appearance-none">
            <option value="">Pilih Kelas...</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
        @error('class_id') <span class="text-xs text-rose-500 mt-1 block ml-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Orang Tua / Wali</label>
        <select wire:model="parent_id"
            class="w-full px-5 py-3.5 bg-gray-50 border-none focus:ring-2 focus:ring-teal-900/10 rounded-2xl text-sm transition-all appearance-none">
            <option value="">Pilih Orang Tua...</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="pt-2">
        <button type="submit"
            wire:loading.attr="disabled"
            class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-teal-500/20 disabled:opacity-50 disabled:cursor-not-allowed group flex items-center justify-center gap-2">
            <span wire:loading.remove wire:target="save">{{ $isEdit ? 'Simpan Perubahan' : 'Daftarkan Siswa' }}</span>
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
