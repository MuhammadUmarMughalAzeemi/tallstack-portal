<div class="space-y-8">
    <!-- OPTION 1: Modern Card Grid -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-100">Option 1: Card Grid Style</h3>
            <span class="text-xs px-2 py-1 bg-indigo-500/20 text-indigo-300 rounded-full">Modern</span>
        </div>
        
        <div class="space-y-4">
            <!-- College Cards -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Preferred College *</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-32 overflow-y-auto pr-2">
                    <button class="p-3 rounded-lg border border-indigo-500/30 bg-indigo-500/10 text-left hover:border-indigo-500/60 transition-all">
                        <p class="text-xs font-semibold text-indigo-300 line-clamp-2">University Medical & Dental College...</p>
                        <p class="text-[10px] text-indigo-400 mt-1">📍 Faisalabad</p>
                    </button>
                    <button class="p-3 rounded-lg border border-slate-700 bg-slate-900/30 text-left hover:border-slate-600 transition-all">
                        <p class="text-xs font-semibold text-slate-300 line-clamp-2">Aga Khan University Medical College</p>
                        <p class="text-[10px] text-slate-500 mt-1">📍 Karachi</p>
                    </button>
                </div>
            </div>

            <!-- Study Mode Pills -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Study Mode *</label>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 rounded-full bg-emerald-600 text-white text-xs font-bold border border-emerald-500">Full-time ✓</button>
                    <button class="px-4 py-2 rounded-full bg-slate-900 text-slate-400 text-xs font-bold border border-slate-700 hover:border-slate-600">Part-time</button>
                    <button class="px-4 py-2 rounded-full bg-slate-900 text-slate-400 text-xs font-bold border border-slate-700 hover:border-slate-600">Online</button>
                </div>
            </div>

            <!-- Campus Toggle -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Campus *</label>
                <div class="inline-flex rounded-lg border border-slate-700 bg-slate-900/40 p-1">
                    <button class="px-4 py-2 rounded-md bg-blue-600 text-white text-xs font-bold">Main Campus</button>
                    <button class="px-4 py-2 rounded-md text-slate-400 text-xs font-bold hover:text-slate-200">Downtown</button>
                    <button class="px-4 py-2 rounded-md text-slate-400 text-xs font-bold hover:text-slate-200">Virtual</button>
                </div>
            </div>
        </div>
    </div>

    <!-- OPTION 2: Tabs Style (Left - College, Center - Mode, Right - Campus) -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-100">Option 2: Three-Column Tabs</h3>
            <span class="text-xs px-2 py-1 bg-purple-500/20 text-purple-300 rounded-full">Elegant</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- College Column -->
            <div class="border border-slate-700 rounded-xl p-4 bg-slate-900/20">
                <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wide mb-3">Step 1: College</h4>
                <div class="space-y-2 max-h-40 overflow-y-auto">
                    <button class="w-full text-left p-2 rounded-lg bg-indigo-600/30 border border-indigo-500/50 text-indigo-200 text-xs font-semibold">✓ Medical & Dental</button>
                    <button class="w-full text-left p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Aga Khan University</button>
                    <button class="w-full text-left p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Allama Iqbal</button>
                </div>
            </div>

            <!-- Study Mode Column -->
            <div class="border border-slate-700 rounded-xl p-4 bg-slate-900/20">
                <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wide mb-3">Step 2: Study Mode</h4>
                <div class="space-y-2">
                    <button class="w-full p-2 rounded-lg bg-emerald-600/30 border border-emerald-500/50 text-emerald-200 text-xs font-semibold">✓ Full-time</button>
                    <button class="w-full p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Part-time</button>
                    <button class="w-full p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Online</button>
                    <button class="w-full p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Hybrid</button>
                </div>
            </div>

            <!-- Campus Column -->
            <div class="border border-slate-700 rounded-xl p-4 bg-slate-900/20">
                <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wide mb-3">Step 3: Campus</h4>
                <div class="space-y-2">
                    <button class="w-full p-2 rounded-lg bg-blue-600/30 border border-blue-500/50 text-blue-200 text-xs font-semibold">✓ Main Campus</button>
                    <button class="w-full p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Downtown Center</button>
                    <button class="w-full p-2 rounded-lg border border-slate-700 text-slate-400 text-xs hover:border-slate-600">Virtual Campus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- OPTION 3: Horizontal Slider/Carousel -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-100">Option 3: Horizontal Carousel</h3>
            <span class="text-xs px-2 py-1 bg-pink-500/20 text-pink-300 rounded-full">Modern</span>
        </div>

        <div class="space-y-4">
            <!-- Scrollable College Cards -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Swipe through colleges →</label>
                <div class="overflow-x-auto pb-2 scrollbar-hide">
                    <div class="flex gap-3 min-w-max pr-4">
                        <div class="flex-shrink-0 w-48 p-3 rounded-xl border-2 border-indigo-500 bg-indigo-500/10 cursor-pointer">
                            <p class="text-sm font-bold text-indigo-300">University Medical & Dental</p>
                            <p class="text-xs text-indigo-400 mt-1">Faisalabad (Women)</p>
                            <p class="text-[10px] text-indigo-500 mt-2">✓ Selected</p>
                        </div>
                        <div class="flex-shrink-0 w-48 p-3 rounded-xl border-2 border-slate-700 bg-slate-900/50 cursor-pointer hover:border-slate-600">
                            <p class="text-sm font-bold text-slate-300">Aga Khan University</p>
                            <p class="text-xs text-slate-500 mt-1">Karachi</p>
                            <p class="text-[10px] text-slate-600 mt-2">← Click to select</p>
                        </div>
                        <div class="flex-shrink-0 w-48 p-3 rounded-xl border-2 border-slate-700 bg-slate-900/50 cursor-pointer hover:border-slate-600">
                            <p class="text-sm font-bold text-slate-300">Allama Iqbal Medical</p>
                            <p class="text-xs text-slate-500 mt-1">Lahore</p>
                            <p class="text-[10px] text-slate-600 mt-2">← Click to select</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mode & Campus in Row -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Mode</label>
                    <select class="w-full bg-slate-900 border border-emerald-500/30 text-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold">
                        <option>✓ Full-time</option>
                        <option>Part-time</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Campus</label>
                    <select class="w-full bg-slate-900 border border-blue-500/30 text-blue-300 rounded-lg px-3 py-2 text-xs font-semibold">
                        <option>✓ Main Campus</option>
                        <option>Downtown Center</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- OPTION 4: Minimal Dropdowns (Premium Style) -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-100">Option 4: Premium Dropdowns</h3>
            <span class="text-xs px-2 py-1 bg-cyan-500/20 text-cyan-300 rounded-full">Minimal</span>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 block">Preferred College *</label>
                <select class="w-full bg-slate-900/60 border border-slate-700 focus:border-purple-500 text-slate-100 rounded-lg px-4 py-3 text-sm font-semibold focus:outline-none transition-all">
                    <option class="bg-slate-900">✓ University Medical & Dental College, Faisalabad (For Women Only)</option>
                    <option class="bg-slate-900">Aga Khan University Medical College, Karachi</option>
                    <option class="bg-slate-900">Allama Iqbal Medical College, Lahore</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 block">Study Mode *</label>
                    <select class="w-full bg-slate-900/60 border border-slate-700 focus:border-emerald-500 text-slate-100 rounded-lg px-4 py-3 text-sm font-semibold focus:outline-none transition-all">
                        <option class="bg-slate-900">✓ Full-time</option>
                        <option class="bg-slate-900">Part-time</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 block">Campus *</label>
                    <select class="w-full bg-slate-900/60 border border-slate-700 focus:border-blue-500 text-slate-100 rounded-lg px-4 py-3 text-sm font-semibold focus:outline-none transition-all">
                        <option class="bg-slate-900">✓ Main Campus</option>
                        <option class="bg-slate-900">Downtown Center</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- OPTION 5: Icon Grid + Radio Buttons -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-100">Option 5: Icon Grid + Radio</h3>
            <span class="text-xs px-2 py-1 bg-rose-500/20 text-rose-300 rounded-full">Visual</span>
        </div>

        <div class="space-y-6">
            <!-- Colleges -->
            <div>
                <label class="text-xs font-bold text-slate-300 uppercase tracking-widest mb-3 block">🏥 Select College</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="relative cursor-pointer group">
                        <input type="radio" name="college" checked class="sr-only">
                        <div class="p-4 rounded-xl border-2 border-indigo-500 bg-indigo-500/10 group-hover:shadow-lg group-hover:shadow-indigo-500/20 transition-all">
                            <p class="font-bold text-sm text-indigo-300 line-clamp-2">University Medical & Dental</p>
                            <p class="text-xs text-indigo-400 mt-1">Faisalabad</p>
                        </div>
                        <div class="absolute top-2 right-2 w-5 h-5 rounded-full bg-indigo-600 flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="relative cursor-pointer group">
                        <input type="radio" name="college" class="sr-only">
                        <div class="p-4 rounded-xl border-2 border-slate-700 bg-slate-900/50 group-hover:border-slate-600 group-hover:shadow-lg transition-all">
                            <p class="font-bold text-sm text-slate-300 line-clamp-2">Aga Khan University</p>
                            <p class="text-xs text-slate-500 mt-1">Karachi</p>
                        </div>
                        <div class="absolute top-2 right-2 w-5 h-5 rounded-full border-2 border-slate-700"></div>
                    </div>
                </div>
            </div>

            <!-- Study Mode -->
            <div>
                <label class="text-xs font-bold text-slate-300 uppercase tracking-widest mb-3 block">📚 Study Mode</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="mode" checked class="sr-only">
                        <div class="p-3 rounded-lg border-2 border-emerald-500 bg-emerald-500/10 text-center">
                            <p class="text-xs font-bold text-emerald-300">Full-time ✓</p>
                        </div>
                    </label>
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="mode" class="sr-only">
                        <div class="p-3 rounded-lg border-2 border-slate-700 bg-slate-900/50 text-center group-hover:border-slate-600">
                            <p class="text-xs font-bold text-slate-400">Part-time</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- OPTION 6: Accordion/Expandable Sections -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-100">Option 6: Accordion Style</h3>
            <span class="text-xs px-2 py-1 bg-violet-500/20 text-violet-300 rounded-full">Organized</span>
        </div>

        <div class="space-y-2">
            <!-- College Accordion -->
            <details class="border border-slate-700 rounded-lg bg-slate-900/40 p-4 group cursor-pointer" open>
                <summary class="flex items-center justify-between text-sm font-bold text-slate-200">
                    <span>📍 College Selection (Expanded)</span>
                    <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </summary>
                <div class="mt-4 space-y-2 max-h-32 overflow-y-auto">
                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-800/50 cursor-pointer">
                        <input type="radio" checked class="w-4 h-4 text-indigo-600">
                        <span class="text-xs text-slate-300">University Medical & Dental College...</span>
                    </label>
                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-800/50 cursor-pointer">
                        <input type="radio" class="w-4 h-4">
                        <span class="text-xs text-slate-400">Aga Khan University Medical College</span>
                    </label>
                </div>
            </details>

            <!-- Mode Accordion -->
            <details class="border border-slate-700 rounded-lg bg-slate-900/40 p-4 group cursor-pointer">
                <summary class="flex items-center justify-between text-sm font-bold text-slate-200">
                    <span>📚 Study Mode (Collapsed)</span>
                    <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </summary>
                <div class="mt-4 space-y-2 grid grid-cols-2 md:grid-cols-4 gap-2">
                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-800/50 cursor-pointer">
                        <input type="radio" checked class="w-4 h-4">
                        <span class="text-xs">Full-time</span>
                    </label>
                </div>
            </details>

            <!-- Campus Accordion -->
            <details class="border border-slate-700 rounded-lg bg-slate-900/40 p-4 group cursor-pointer">
                <summary class="flex items-center justify-between text-sm font-bold text-slate-200">
                    <span>🗺️ Campus Location (Collapsed)</span>
                    <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </summary>
                <div class="mt-4 space-y-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-800/50 cursor-pointer">
                        <input type="radio" checked class="w-4 h-4">
                        <span class="text-xs">Main Campus</span>
                    </label>
                </div>
            </details>
        </div>
    </div>

    <!-- Navigation -->
    <div class="bg-slate-950/40 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 flex justify-between gap-4">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </button>

        <button type="button" wire:click="save" wire:loading.attr="disabled" wire:target="save"
            class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold shadow-lg shadow-emerald-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <svg wire:loading.remove wire:target="save" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span wire:loading.remove wire:target="save">Save & Continue</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>
