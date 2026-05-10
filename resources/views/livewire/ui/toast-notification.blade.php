<div
    x-data="{ 
        notifications: [],
        add(notification) {
            this.notifications.push({
                ...notification,
                show: false
            });
            
            this.$nextTick(() => {
                const index = this.notifications.length - 1;
                this.notifications[index].show = true;
                
                setTimeout(() => {
                    this.remove(notification.id);
                }, 3000);
            });
        },
        remove(id) {
            const index = this.notifications.findIndex(n => n.id === id);
            if (index > -1) {
                this.notifications[index].show = false;
                setTimeout(() => {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }, 500);
            }
        }
    }"
    @toast-added.window="add($event.detail)"
    class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 w-full max-w-sm pointer-events-none"
    x-cloak
>
    <template x-for="n in notifications" :key="n.id">
        <div
            x-show="n.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-12 scale-90"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-12 scale-90"
            class="pointer-events-auto relative overflow-hidden group"
        >
            <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-[1.5rem] shadow-[0_15px_35px_rgba(0,0,0,0.1)] p-4 pr-12 flex items-center gap-4">
                {{-- Success Icon --}}
                <div x-show="n.type === 'success'" class="w-10 h-10 bg-teal-500 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-teal-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                
                {{-- Error Icon --}}
                <div x-show="n.type === 'error'" class="w-10 h-10 bg-red-500 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-red-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] mb-0.5" :class="n.type === 'success' ? 'text-teal-600' : 'text-red-600'" x-text="n.type === 'success' ? 'Success' : 'Error'"></p>
                    <p class="text-slate-800 font-bold text-sm truncate" x-text="n.message"></p>
                </div>

                {{-- Close Button --}}
                <button @click="remove(n.id)" class="absolute top-4 right-4 text-slate-300 hover:text-slate-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                {{-- Progress Bar (Auto-close visualization) --}}
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-teal-500/50 to-teal-500 rounded-full transition-all duration-[3000ms] ease-linear w-full" 
                     :class="n.type === 'error' ? 'from-red-500/50 to-red-500' : ''"
                     style="width: 0%;" 
                     x-init="setTimeout(() => $el.style.width = '100%', 50)">
                </div>
            </div>
        </div>
    </template>
</div>
