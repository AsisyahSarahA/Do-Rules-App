<header class="flex justify-between items-center w-full mb-8">
    <!-- Search Bar -->
    <div class="relative w-full max-w-md">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" class="block w-full pl-10 pr-12 py-2.5 bg-white border border-gray-100 rounded-2xl text-sm text-gray-600 focus:ring-2 focus:ring-donezo-primary/20 focus:border-donezo-primary/30 shadow-sm" placeholder="Search task">
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <span class="text-xs text-gray-400 font-medium bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">⌘F</span>
        </div>
    </div>
    
    <!-- Right Actions -->
    <div class="flex items-center gap-4">
        <!-- Messages -->
        <button class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-500 hover:text-donezo-primary hover:bg-donezo-light transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </button>
        
        <!-- Notifications -->
        <button class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-500 hover:text-donezo-primary hover:bg-donezo-light transition-colors shadow-sm relative">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="absolute top-2.5 right-2.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
        </button>
        
        <!-- User Profile -->
        <div class="flex items-center gap-3 pl-2 ml-2">
            <div class="w-10 h-10 rounded-full bg-orange-100 overflow-hidden border border-orange-200">
                <!-- Fallback avatar using user initials -->
                <div class="w-full h-full flex items-center justify-center text-orange-600 font-bold text-sm">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
            </div>
            <div class="hidden md:block">
                <p class="text-sm font-bold text-donezo-text">{{ auth()->user()->name ?? 'Totok Michael' }}</p>
                <p class="text-[11px] text-gray-400 font-medium">{{ auth()->user()->email ?? 'tmichael20@mail.com' }}</p>
            </div>
        </div>
    </div>
</header>
