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

        <button
            wire:click="$toggle('showForm')"
            class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-teal-500/20 transition-all"
        >
            {{ $showForm ? 'Tutup Form' : '+ Tambah Pelanggaran' }}
        </button>

    </div>

    {{-- FLASH --}}
    @if(session()->has('message'))

        <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-5 py-4 rounded-2xl">
            {{ session('message') }}
        </div>

    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- FORM --}}
        @if($showForm)

            <div class="lg:col-span-4">

                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">

                    <h3 class="text-xl font-black text-slate-800 mb-8">
                        Input Pelanggaran
                    </h3>

                    <form wire:submit.prevent="save" class="space-y-5">

                        {{-- siswa --}}
                        <div>

                            <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                                Siswa
                            </label>

                            <select
                                wire:model="student_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4"
                            >
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

                            <select
                                wire:model="rule_id"
                                class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4"
                            >
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

                            <textarea
                                wire:model="notes"
                                rows="4"
                                class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4"
                            ></textarea>

                        </div>

                        {{-- upload --}}
                        <div>

                            <label class="text-xs uppercase font-bold text-gray-400 mb-2 block">
                                Bukti Foto
                            </label>

                            <input
                                type="file"
                                wire:model="evidence"
                                accept="image/*"
                                capture="environment"
                                class="w-full bg-gray-50 rounded-2xl px-5 py-4"
                            >

                            @if($evidence)

                                <img
                                    src="{{ $evidence->temporaryUrl() }}"
                                    class="mt-4 rounded-2xl w-full h-52 object-cover"
                                >

                            @endif

                        </div>

                        <button
                            type="submit"
                            class="w-full bg-teal-500 hover:bg-teal-600 text-white py-4 rounded-2xl font-bold"
                        >
                            Simpan Pelanggaran
                        </button>

                    </form>

                </div>

            </div>

        @endif

        {{-- TABLE --}}
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }}">

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">

                {{-- SEARCH --}}
                <div class="p-6 border-b border-gray-100">

                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Cari siswa..."
                        class="w-full sm:w-72 bg-gray-50 border-none rounded-full px-5 py-3"
                    >

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="text-left text-[11px] uppercase tracking-[0.2em] text-gray-400 bg-gray-50">

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

                                <tr
                                    wire:click="showDetail({{ $violation->id }})"
                                    class="hover:bg-gray-50 cursor-pointer transition-all"
                                >

                                    <td class="px-8 py-5 font-bold text-slate-700">
                                        {{ $violation->student->name }}
                                    </td>

                                    <td class="px-8 py-5">
                                        {{ $violation->rule->name }}
                                    </td>

                                    <td class="px-8 py-5">
                                        {{ $violation->rule->point }}
                                    </td>

                                    <td class="px-8 py-5">

                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            {{ $violation->status == 'approved'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : 'bg-amber-50 text-amber-600' }}">
                                            {{ $violation->status }}
                                        </span>

                                    </td>

                                    <td class="px-8 py-5 text-sm text-gray-500">

                                        <div class="flex flex-col">

                                            <span>
                                                {{ $violation->created_at->format('d M Y') }}
                                            </span>

                                            <span class="text-xs text-gray-400">
                                                {{ $violation->created_at->format('H:i') }} WIB
                                            </span>

                                        </div>

                                    </td>

                                    <td class="px-8 py-5 text-center">

                                        <button
                                            wire:click.stop="delete({{ $violation->id }})"
                                            class="text-rose-500 hover:text-rose-700"
                                        >
                                            Hapus
                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-20 text-gray-400">
                                        Belum ada data pelanggaran
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- MODAL DETAIL --}}
    @if($selectedViolation)

        <div class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-6">

            <div class="bg-white rounded-[2rem] w-full max-w-2xl p-8 relative">

                <button
                    wire:click="$set('selectedViolation', null)"
                    class="absolute top-5 right-5 text-gray-400"
                >
                    ✕
                </button>

                <h2 class="text-2xl font-black mb-8">
                    Detail Pelanggaran
                </h2>

                <div class="space-y-6">

                    <div>
                        <p class="text-xs uppercase text-gray-400 font-bold">
                            Siswa
                        </p>

                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $selectedViolation->student->name }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-400 font-bold">
                            Pelanggaran
                        </p>

                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $selectedViolation->rule->name }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-400 font-bold">
                            Dilaporkan Oleh
                        </p>

                        <h3 class="text-lg font-bold text-slate-700">
                            {{ $selectedViolation->reporter->name ?? '-' }}
                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            {{ $selectedViolation->created_at->format('d M Y H:i') }} WIB
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-400 font-bold">
                            Diverifikasi Oleh
                        </p>

                        <h3 class="text-lg font-bold text-slate-700">
                            {{ $selectedViolation->verifier->name ?? 'Belum diverifikasi' }}
                        </h3>

                        @if($selectedViolation->verified_at)

                            <p class="text-sm text-gray-400 mt-1">
                                {{ \Carbon\Carbon::parse($selectedViolation->verified_at)->format('d M Y H:i') }} WIB
                            </p>

                        @endif
                    </div>

                    @if($selectedViolation->notes)

                        <div>

                            <p class="text-xs uppercase text-gray-400 font-bold">
                                Catatan
                            </p>

                            <p class="mt-2 text-slate-600 leading-relaxed">
                                {{ $selectedViolation->notes }}
                            </p>

                        </div>

                    @endif

                    @if($selectedViolation->evidence)

                        <div>

                            <p class="text-xs uppercase text-gray-400 font-bold mb-3">
                                Bukti Foto
                            </p>

                            <img
                                src="{{ asset('storage/' . $selectedViolation->evidence) }}"
                                class="rounded-2xl w-full"
                            >

                        </div>

                    @endif

                </div>

            </div>

        </div>

    @endif

</div>