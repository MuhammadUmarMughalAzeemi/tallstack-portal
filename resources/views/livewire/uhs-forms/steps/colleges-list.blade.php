<form
    class="space-y-8 font-sans"
    @if(count($selectedPrograms) > 0)
        x-data="programPreferences({{ Js::from($pickerConfig) }})"
        @submit.prevent="await $wire.set('preferencesByProgram', exportRanked(), false); $wire.submit()"
    @else
        wire:submit="submit"
    @endif
>

    <!-- Header -->
    <div class="border-b border-slate-800 pb-4 space-y-1 light:border-slate-200">
        <h2 class="text-xl font-bold text-slate-100 light:text-slate-900">Step 4: Choose Your Preferences</h2>
        <p class="text-slate-400 text-sm light:text-slate-600">
            @if(count($selectedPrograms) > 1)
                Each selected program has its own specialty list. Switch tabs to set preferences separately.
            @elseif(count($selectedPrograms) === 1)
                Select specialties for <span class="text-indigo-400 font-semibold light:text-indigo-700">{{ $selectedPrograms[0]['name'] }}</span>.
            @else
                Select your specialty preference.
            @endif
        </p>
    </div>

    @if(count($selectedPrograms) === 0)
        <div class="flex items-center gap-4 p-6 bg-amber-950/30 border border-amber-700 rounded-2xl light:bg-amber-50 light:border-amber-300">
            <svg class="w-8 h-8 text-amber-400 light:text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <div>
                <p class="text-amber-300 font-bold light:text-amber-900">No program selected</p>
                <p class="text-amber-400/80 text-xs mt-1 light:text-amber-700">Please go back to Step 1 and select a seat category first.</p>
            </div>
        </div>
    @else
        <div wire:ignore class="space-y-4">
            <!-- Program Tabs -->
            @if(count($selectedPrograms) > 1)
                <div class="flex flex-wrap gap-2">
                    <template x-for="program in programs" :key="program.id">
                        <button type="button"
                            @click="switchTo(program.id)"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
                            :class="Number(activeId) === Number(program.id)
                                ? 'bg-indigo-600 text-white border-indigo-500 shadow-md shadow-indigo-600/30'
                                : 'bg-slate-800 text-slate-300 border-slate-700 hover:border-slate-500 hover:text-white light:bg-white light:text-slate-700 light:border-slate-300 light:hover:bg-slate-100 light:hover:border-slate-400'">
                            <span class="inline-flex items-center gap-2">
                                <span x-text="program.name"></span>
                                <span x-show="count(program.id) > 0" class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-emerald-600 text-white text-[10px] font-bold">✓</span>
                            </span>
                        </button>
                    </template>
                </div>
            @endif

            <!-- Search & Selected Counter -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-400 light:text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search specialties..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm light:bg-white light:border-slate-300 light:text-slate-900 light:placeholder-slate-400">
                </div>
                <div class="flex items-center gap-2 text-xs font-bold">
                    <span class="px-3 py-1.5 rounded-lg bg-slate-800 text-slate-200 border border-slate-700 light:bg-slate-100 light:text-slate-800 light:border-slate-300 shadow-sm" x-text="(active ? active.name : '')"></span>
                    <span class="px-3 py-1.5 rounded-lg bg-indigo-950 text-indigo-300 border border-indigo-800 light:bg-indigo-50 light:text-indigo-800 light:border-indigo-200 shadow-sm" x-text="count(activeId) + ' selected'"></span>
                </div>
            </div>

            <!-- Two-Column Preferences Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-start">
                
                <!-- Left Column: Available Specialties -->
                <div class="order-2 lg:order-1 rounded-2xl border border-slate-700 bg-slate-900 overflow-hidden shadow-sm light:bg-white light:border-slate-300">
                    <div class="px-4 py-3 border-b border-slate-800 bg-slate-950/60 flex items-center justify-between light:border-slate-200 light:bg-slate-50">
                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest light:text-slate-700">Available Specialties</p>
                        <p class="text-[11px] text-slate-400 font-medium light:text-slate-500" x-text="active && active.mode === 'ranked' ? 'Click to add' : 'Click to choose'"></p>
                    </div>
                    <div class="p-2 max-h-[28rem] overflow-y-auto space-y-1.5">
                        <template x-for="college in available" :key="college.id">
                            <button type="button"
                                @click="add(college.name)"
                                class="group w-full flex items-center gap-3 p-3 rounded-xl border text-left transition-all"
                                :class="isSelected(college.name)
                                    ? 'border-indigo-500/60 bg-indigo-950/30 light:border-indigo-300 light:bg-indigo-50'
                                    : 'border-slate-800 bg-slate-950/50 hover:bg-slate-800 hover:border-slate-600 light:border-slate-200 light:bg-slate-50/50 light:hover:bg-indigo-50/60 light:hover:border-indigo-200'">
                                <span class="flex-shrink-0 w-8 h-8 rounded-lg border flex items-center justify-center transition-colors"
                                    :class="isSelected(college.name)
                                        ? 'border-indigo-500 bg-indigo-600 text-white'
                                        : 'border-slate-700 bg-slate-800 text-slate-300 group-hover:border-indigo-500 group-hover:text-indigo-400 light:border-slate-300 light:bg-white light:text-slate-600 light:group-hover:border-indigo-500 light:group-hover:text-indigo-600'">
                                    <svg x-show="!isSelected(college.name)" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <svg x-show="isSelected(college.name)" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                    </svg>
                                </span>
                                <span class="text-sm font-semibold text-slate-200 group-hover:text-white light:text-slate-800 light:group-hover:text-indigo-950" x-text="college.name"></span>
                            </button>
                        </template>

                        <p x-show="availableTotal === 0 && (!active || active.mode === 'ranked')" class="text-center py-10 text-slate-400 text-sm light:text-slate-500">All specialties have been added to this program.</p>
                        <p x-show="availableTotal > 0 && available.length === 0" class="text-center py-8 text-slate-400 text-sm light:text-slate-500">No specialties match your search.</p>
                    </div>
                </div>

                <!-- Right Column: Ranked Preferences -->
                <div class="order-1 lg:order-2 rounded-2xl border border-indigo-500/40 bg-slate-900 overflow-hidden lg:sticky lg:top-24 shadow-sm light:bg-white light:border-slate-300">
                    <div class="px-4 py-3 border-b border-slate-800 bg-slate-950/60 flex items-center justify-between gap-2 light:border-slate-200 light:bg-slate-50">
                        <div>
                            <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest light:text-indigo-700">
                                <span x-text="active && active.mode === 'ranked' ? 'Ranked Preferences' : 'Your Choice'"></span>
                            </p>
                            <p class="text-[11px] text-slate-400 font-medium light:text-slate-500 mt-0.5" x-text="active && active.mode === 'ranked' ? 'Drag the handle, or use arrows to reorder' : 'One specialty for this program'"></p>
                        </div>
                        <button type="button" x-show="count(activeId) > 0" @click="clear()" class="text-xs font-bold text-slate-400 hover:text-rose-400 light:text-slate-500 light:hover:text-rose-600 transition-colors">
                            Clear
                        </button>
                    </div>

                    <!-- Empty state -->
                    <div x-show="count(activeId) === 0" class="m-3 p-8 rounded-xl border border-dashed border-slate-700 bg-slate-950/30 text-center light:border-slate-300 light:bg-slate-50">
                        <div class="mx-auto w-10 h-10 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center mb-3 light:bg-indigo-50 light:border-indigo-200">
                            <svg class="w-5 h-5 text-indigo-400 light:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-slate-200 light:text-slate-800">No specialty selected for this program</p>
                        <p class="text-xs text-slate-400 mt-1 light:text-slate-500">Choose from the list. Other program tabs keep their own lists.</p>
                    </div>

                    <!-- Sorted List -->
                    <div
                        x-show="count(activeId) > 0"
                        x-sortable
                        @sorted="applySort($event.detail)"
                        class="p-2 space-y-2 max-h-[28rem] overflow-y-auto"
                    >
                        <template x-for="(subject, index) in list()" :key="subject">
                            <div :data-id="subject" class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-700 bg-slate-950/70 light:border-slate-200 light:bg-slate-50/70 transition-all shadow-sm">
                                <span x-show="active && active.mode === 'ranked'" class="drag-handle flex-shrink-0 p-1.5 rounded-lg text-slate-400 hover:text-indigo-400 hover:bg-slate-800 light:text-slate-400 light:hover:text-indigo-600 light:hover:bg-slate-200 cursor-grab" title="Drag to reorder">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 4a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm8-12a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0z"/>
                                    </svg>
                                </span>

                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow-sm">
                                    <span class="text-xs font-bold" x-text="index + 1"></span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-400 light:text-indigo-700" x-text="active && active.mode === 'ranked' ? (ordinal(index + 1) + ' preference') : 'Selected specialty'"></p>
                                    <p class="text-sm font-semibold text-slate-100 truncate light:text-slate-900" x-text="subject"></p>
                                </div>

                                <div class="flex items-center gap-0.5">
                                    <template x-if="active && active.mode === 'ranked'">
                                        <div class="flex items-center">
                                            <button type="button" @click="moveUp(index)" :disabled="index === 0"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 disabled:opacity-30 light:text-slate-500 light:hover:text-slate-900 light:hover:bg-slate-200"
                                                title="Move up">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                                </svg>
                                            </button>
                                            <button type="button" @click="moveDown(index)" :disabled="index === list().length - 1"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 disabled:opacity-30 light:text-slate-500 light:hover:text-slate-900 light:hover:bg-slate-200"
                                                title="Move down">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <button type="button" @click="remove(index)"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 light:text-slate-500 light:hover:text-rose-600 light:hover:bg-rose-50"
                                        title="Remove">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Bottom Notice -->
            <div class="flex items-start gap-2.5 p-3 bg-slate-900 border border-slate-700 rounded-xl light:bg-slate-50 light:border-slate-200">
                <svg class="w-4 h-4 text-indigo-400 light:text-indigo-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>
                <p class="text-xs text-slate-300 light:text-slate-700 font-medium">Preferences are saved per program. Switching tabs does not mix or overwrite another program’s list.</p>
            </div>
        </div>
    @endif

    @error('preferences')
        <div class="flex items-center gap-3 p-4 bg-rose-950/40 border border-rose-700 rounded-xl light:bg-rose-50 light:border-rose-300">
            <svg class="w-5 h-5 text-rose-400 light:text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <span class="text-sm font-semibold text-rose-400 light:text-rose-700">{{ $message }}</span>
        </div>
    @enderror

    <!-- Navigation Buttons -->
    <div class="flex justify-between pt-6 border-t border-slate-800 light:border-slate-200">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 hover:border-slate-600 text-xs sm:text-sm font-bold tracking-wide transition-all flex items-center gap-2 disabled:opacity-50 shadow-sm light:bg-white light:hover:bg-slate-100 light:text-slate-800 light:border-slate-300 light:hover:border-slate-400">
            <svg class="w-4 h-4 text-slate-400 light:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Back</span>
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="submit">Continue</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
