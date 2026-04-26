<div>

            <!-- Page Title & Actions -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-donezo-text tracking-tight mb-1">Dashboard</h2>
                    <p class="text-sm text-gray-500">Plan, prioritize, and accomplish your tasks with ease.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="bg-donezo-primary hover:bg-donezo-primary/90 text-white text-sm font-semibold px-5 py-2.5 rounded-full flex items-center gap-2 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add Project
                    </button>
                    <button
                        class="bg-white hover:bg-gray-50 text-donezo-text text-sm font-semibold px-5 py-2.5 rounded-full border border-gray-200 transition-colors shadow-sm">
                        Import Data
                    </button>
                </div>
            </div>

            <!-- 4 Stat Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Card 1 (Dark Green) -->
                <div
                    class="bg-donezo-primary rounded-2xl p-5 text-white shadow-sm relative overflow-hidden group cursor-pointer">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-medium text-white/90">Total Projects</h3>
                        <div
                            class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-donezo-primary group-hover:scale-110 transition-transform">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold mb-4">24</div>
                    <div
                        class="flex items-center gap-1.5 text-xs font-medium text-donezo-accent bg-white/10 w-fit px-2 py-1 rounded">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Increased from last month
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm relative overflow-hidden group cursor-pointer hover:border-donezo-border transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-medium text-gray-500">Ended Projects</h3>
                        <div
                            class="w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-donezo-primary group-hover:text-donezo-primary transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold mb-4 text-donezo-text">10</div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                        <svg class="w-3 h-3 text-donezo-accent" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Increased from last month
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm relative overflow-hidden group cursor-pointer hover:border-donezo-border transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-medium text-gray-500">Running Projects</h3>
                        <div
                            class="w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-donezo-primary group-hover:text-donezo-primary transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold mb-4 text-donezo-text">12</div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                        <svg class="w-3 h-3 text-donezo-accent" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Increased from last month
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm relative overflow-hidden group cursor-pointer hover:border-donezo-border transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-medium text-gray-500">Pending Project</h3>
                        <div
                            class="w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-donezo-primary group-hover:text-donezo-primary transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-4xl font-bold mb-4 text-donezo-text">2</div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                        <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                        On Discuss
                    </div>
                </div>
            </div>

            <!-- Middle Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Analytics Chart -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm lg:col-span-1">
                    <h3 class="text-base font-bold text-donezo-text mb-6">Project Analytics</h3>
                    <div class="flex items-end justify-between h-32 mb-2">
                        <!-- S -->
                        <div
                            class="w-8 h-16 bg-gray-100 rounded-t-full rounded-b-full border border-gray-200 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiAvPgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2UyZThmMCIgc3Ryb2tlLXdpZHRoPSIxIi8+Cjwvc3ZnPg==')] opacity-50">
                            </div>
                        </div>
                        <!-- M -->
                        <div class="w-8 h-24 bg-donezo-primary rounded-t-full rounded-b-full shadow-sm"></div>
                        <!-- T -->
                        <div class="w-8 h-20 bg-donezo-accent rounded-t-full rounded-b-full shadow-sm relative">
                            <div
                                class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold text-donezo-accent bg-donezo-light px-1.5 py-0.5 rounded border border-donezo-accent/20">
                                74%</div>
                        </div>
                        <!-- W -->
                        <div class="w-8 h-full bg-donezo-dark rounded-t-full rounded-b-full shadow-sm"></div>
                        <!-- T -->
                        <div
                            class="w-8 h-20 bg-gray-100 rounded-t-full rounded-b-full border border-gray-200 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiAvPgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2UyZThmMCIgc3Ryb2tlLXdpZHRoPSIxIi8+Cjwvc3ZnPg==')] opacity-50">
                            </div>
                        </div>
                        <!-- F -->
                        <div
                            class="w-8 h-16 bg-gray-100 rounded-t-full rounded-b-full border border-gray-200 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiAvPgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2UyZThmMCIgc3Ryb2tlLXdpZHRoPSIxIi8+Cjwvc3ZnPg==')] opacity-50">
                            </div>
                        </div>
                        <!-- S -->
                        <div
                            class="w-8 h-14 bg-gray-100 rounded-t-full rounded-b-full border border-gray-200 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiAvPgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2UyZThmMCIgc3Ryb2tlLXdpZHRoPSIxIi8+Cjwvc3ZnPg==')] opacity-50">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between text-[10px] font-bold text-gray-400 px-2">
                        <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
                    </div>
                </div>

                <!-- Reminders -->
                <div
                    class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm lg:col-span-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-bold text-donezo-text mb-4">Reminders</h3>
                        <h4 class="text-xl font-bold text-donezo-dark leading-tight mb-2">Meeting with Arc<br>Company
                        </h4>
                        <p class="text-xs text-gray-400 font-medium">Time : 02.00 pm - 04.00 pm</p>
                    </div>
                    <button
                        class="w-full bg-donezo-primary hover:bg-donezo-primary/90 text-white text-sm font-semibold py-3 rounded-full flex items-center justify-center gap-2 transition-colors mt-6 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Start Meeting
                    </button>
                </div>

                <!-- Project List -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm lg:col-span-1">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-base font-bold text-donezo-text">Project</h3>
                        <button
                            class="text-xs font-bold text-donezo-text border border-gray-200 px-3 py-1.5 rounded-full hover:bg-gray-50 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            New
                        </button>
                    </div>
                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-donezo-text mb-0.5">Develop API Endpoints</h4>
                                <p class="text-[10px] text-gray-400">Due date: Nov 26, 2024</p>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-teal-500 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-donezo-text mb-0.5">Onboarding Flow</h4>
                                <p class="text-[10px] text-gray-400">Due date: Nov 28, 2024</p>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-donezo-primary mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-donezo-text mb-0.5">Build Dashboard</h4>
                                <p class="text-[10px] text-gray-400">Due date: Nov 30, 2024</p>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-donezo-text mb-0.5">Optimize Page Load</h4>
                                <p class="text-[10px] text-gray-400">Due date: Dec 5, 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Team Collaboration -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm lg:col-span-1">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-base font-bold text-donezo-text">Team Collaboration</h3>
                        <button
                            class="text-xs font-bold text-donezo-text border border-gray-200 px-3 py-1.5 rounded-full hover:bg-gray-50 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Member
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-lg">
                                    👩🏻‍🦰</div>
                                <div>
                                    <h4 class="text-sm font-bold text-donezo-text">Alexandra Deff</h4>
                                    <p class="text-[10px] text-gray-400">Working on <span
                                            class="font-semibold text-gray-500">Github Project Repository</span></p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-donezo-accent bg-emerald-50 px-2 py-1 rounded">Completed</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-lg">
                                    👨🏽‍🦱</div>
                                <div>
                                    <h4 class="text-sm font-bold text-donezo-text">Edwin Adenike</h4>
                                    <p class="text-[10px] text-gray-400">Working on <span
                                            class="font-semibold text-gray-500">Integrate User Auth...</span></p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded">In
                                Progress</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-lg">
                                    👨🏿‍🦱</div>
                                <div>
                                    <h4 class="text-sm font-bold text-donezo-text">Isaac Oluwatemilorun</h4>
                                    <p class="text-[10px] text-gray-400">Working on <span
                                            class="font-semibold text-gray-500">Develop Search and...</span></p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded">Pending</span>
                        </div>
                    </div>
                </div>

                <!-- Project Progress -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm lg:col-span-1">
                    <h3 class="text-base font-bold text-donezo-text mb-6">Project Progress</h3>
                    <div class="relative w-48 h-48 mx-auto flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-180" viewBox="0 0 100 100">
                            <!-- Striped pending bg -->
                            <path d="M 10,50 A 40,40 0 0,1 90,50" fill="none" stroke="#f1f5f9" stroke-width="12"
                                stroke-linecap="round" />
                            <!-- In Progress -->
                            <path d="M 10,50 A 40,40 0 0,1 90,50" fill="none" stroke="#0e3f2b" stroke-width="12"
                                stroke-linecap="round" stroke-dasharray="125" stroke-dashoffset="30" />
                            <!-- Completed -->
                            <path d="M 10,50 A 40,40 0 0,1 90,50" fill="none" stroke="#175e3a" stroke-width="12"
                                stroke-linecap="round" stroke-dasharray="125" stroke-dashoffset="75" />
                        </svg>
                        <div class="absolute text-center mt-6">
                            <p class="text-4xl font-bold text-donezo-text">41%</p>
                            <p class="text-[10px] text-gray-400 font-medium">Project Ended</p>
                        </div>
                    </div>
                    <div class="flex justify-center gap-4 mt-2">
                        <div class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-donezo-primary"></span><span
                                class="text-[10px] font-bold text-gray-500">Completed</span></div>
                        <div class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-donezo-dark"></span><span
                                class="text-[10px] font-bold text-gray-500">In Progress</span></div>
                        <div class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full border-2 border-gray-200"></span><span
                                class="text-[10px] font-bold text-gray-400">Pending</span></div>
                    </div>
                </div>

                <!-- Time Tracker -->
                <div
                    class="bg-gradient-to-br from-donezo-dark to-[#082a1c] rounded-2xl p-6 shadow-sm lg:col-span-1 relative overflow-hidden text-white flex flex-col justify-between h-full min-h-[200px]">
                    <!-- Decorative background lines -->
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.1) 10px, rgba(255,255,255,0.1) 20px);">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-donezo-dark/80 to-transparent"></div>

                    <div class="relative z-10">
                        <h3 class="text-sm font-bold mb-4">Time Tracker</h3>
                        <div class="text-center mt-4 mb-6">
                            <p class="text-4xl font-bold tracking-wider">01:24:08</p>
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <button
                                class="w-10 h-10 rounded-full bg-white text-donezo-dark flex items-center justify-center hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 4h4v16H6zM14 4h4v16h-4z"></path>
                                </svg>
                            </button>
                            <button
                                class="w-10 h-10 rounded-full bg-rose-500 text-white flex items-center justify-center hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <rect x="6" y="6" width="12" height="12" rx="2"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>
            </div>
</div>
