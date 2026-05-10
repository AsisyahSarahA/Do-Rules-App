<div
    x-data="{ 
        show: @entangle('isOpen'),
        loading: false
    }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-[9999] overflow-y-auto"
    x-cloak
>
    {{-- Backdrop --}}
    <div 
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        {{-- Modal Panel --}}
        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.away="show = false"
            class="relative transform overflow-hidden rounded-[2rem] bg-white p-8 text-left shadow-[0_20px_50px_rgba(0,0,0,0.2)] transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-100"
        >
            <div class="absolute -right-12 -top-12 w-48 h-48 bg-red-50 rounded-full opacity-50"></div>

            <div class="relative">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50 text-red-500 shadow-sm border border-red-100">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>

                <div class="mt-6 text-center">
                    <h3 class="text-xl font-bold text-slate-800 leading-6" id="modal-title">
                        {{ $title }}
                    </h3>
                    <div class="mt-3">
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <button 
                    type="button" 
                    class="flex-1 inline-flex justify-center items-center rounded-2xl bg-white px-6 py-3.5 text-sm font-bold text-slate-600 shadow-sm border border-slate-200 hover:bg-slate-50 transition-all duration-200" 
                    @click="show = false"
                >
                    Batal
                </button>
                <button 
                    type="button" 
                    class="flex-1 inline-flex justify-center items-center rounded-2xl bg-red-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-red-500/20 hover:bg-red-600 hover:shadow-red-600/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group"
                    wire:click="confirm"
                    wire:loading.attr="disabled"
                    @click="loading = true"
                >
                    <span wire:loading.remove wire:target="confirm">Ya, Hapus</span>
                    <span wire:loading wire:target="confirm" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
