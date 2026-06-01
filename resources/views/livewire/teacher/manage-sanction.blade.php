<div class="p-6 max-w-7xl mx-auto">
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-medium text-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Daftar Sanksi Kelas</h2>
        <p class="text-sm text-gray-500">Pantau dan verifikasi pelaksanaan sanksi murid kelas Anda menggunakan kamera langsung.</p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/75 border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Siswa</th>
                        <th class="px-6 py-4">Pelanggaran</th>
                        <th class="px-6 py-4">Sanksi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($sanctions as $sanction)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-700">
                                {{ $sanction->violation->student->name ?? 'N/A' }}
                                <span class="block text-xs font-normal text-gray-400">Kelas {{ $sanction->violation->student->classroom->name ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $sanction->violation->rule->name ?? 'Pelanggaran' }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 italic">
                                "{{ $sanction->action }}"
                            </td>
                            <td class="px-6 py-4">
                                {{-- INTEGRASI ENUM: Menampilkan warna dan nama status dinamis (Tertunda, Proses, Selesai) --}}
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $sanction->status->color() }} {{ $sanction->status->value === 'pending' ? 'animate-pulse' : '' }}">
                                    {{ $sanction->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                {{-- INTEGRASI ENUM: Mengizinkan proses sanksi jika belum completed --}}
                                @if($sanction->status->value !== 'completed')
                                    <button wire:click="openSanctionModal({{ $sanction->id }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-donezo-primary hover:bg-donezo-primary/90 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm shadow-donezo-primary/10">
                                        Selesaikan
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 font-medium">Diverifikasi pada {{ $sanction->completed_at ? $sanction->completed_at->format('d M Y') : '-' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada sanksi yang tercatat untuk kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL KAMERA REAL-TIME --}}
    @if($isModalOpen)
    <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4"
         x-data="{
            stream: null,
            showCamera: true,
            initCamera() {
                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                    .then(str => {
                        this.stream = str;
                        $refs.videoElement.srcObject = str;
                    })
                    .catch(err => {
                        alert('Gagal mengakses kamera: ' + err);
                    });
            },
            takeSnap() {
                let video = $refs.videoElement;
                let canvas = $refs.canvasElement;
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                let ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                let base64 = canvas.toDataURL('image/jpeg');
                @this.call('setCapturedImage', base64);
                this.stopCamera();
                this.showCamera = false;
            },
            stopCamera() {
                if(this.stream) {
                    this.stream.getTracks().forEach(track => track.stop());
                }
            }
         }"
         x-init="initCamera()"
         x-on:keydown.escape.window="stopCamera(); @this.call('closeSanctionModal')">

        <div class="bg-white rounded-2xl max-w-md w-full shadow-xl overflow-hidden border border-gray-100 flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-800">Ambil Bukti Sanksi</h3>
                <button type="button" @click="stopCamera(); @this.call('closeSanctionModal')" class="text-gray-400 hover:text-gray-600 text-lg">&times;</button>
            </div>

            <div class="p-6 overflow-y-auto flex-1 space-y-4">
                <div class="relative w-full aspect-video bg-black rounded-xl overflow-hidden border border-gray-200 shadow-inner">
                    <video x-show="showCamera" x-ref="videoElement" autoplay playsinline class="w-full h-full object-cover"></video>

                    @if($capturedImage)
                        <img src="{{ $capturedImage }}" class="w-full h-full object-cover" />
                    @endif

                    <canvas x-ref="canvasElement" class="hidden"></canvas>
                </div>

                <div class="flex justify-center">
                    <template x-if="showCamera">
                        <button type="button" @click="takeSnap()" class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white font-semibold text-xs rounded-full flex items-center gap-1.5 shadow-md shadow-rose-500/20 transition-all transform active:scale-95">
                            <span class="w-2.5 h-2.5 rounded-full bg-white animate-ping"></span>
                            Jepret Bukti Real-time
                        </button>
                    </template>
                    <template x-if="!showCamera">
                        <button type="button" @click="showCamera = true; initCamera();" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold text-xs rounded-full transition-all">
                            🔄 Foto Ulang
                        </button>
                    </template>
                </div>

                @error('capturedImage')
                    <span class="text-xs text-rose-500 font-medium block text-center">{{ $message }}</span>
                @enderror

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block">Catatan Wali Kelas</label>
                    <textarea wire:model="notes" rows="2" class="w-full p-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-donezo-primary/20 focus:border-donezo-primary resize-none placeholder:text-gray-300" placeholder="Contoh: Siswa sudah mengaji dan membersihkan ruang kelas dengan tertib."></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-2">
                <button type="button" @click="stopCamera(); @this.call('closeSanctionModal')" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700 transition-colors">Batal</button>
                <button type="button" wire:click="submitEvidence" class="px-4 py-2 bg-donezo-primary hover:bg-donezo-primary/90 text-white text-xs font-bold rounded-xl transition-colors shadow-sm">Simpan & Selesaikan</button>
            </div>
        </div>
    </div>
    @endif
</div>