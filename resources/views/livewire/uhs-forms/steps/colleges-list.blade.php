@php
    $isMphil = $seatCategoryId === $mphilId;
    $isPhd = $seatCategoryId === $phdId;
    $selectedSingle = $isPhd ? $selectPhdSubject : $selectMasterSubject;
    $toggleMethod = $isPhd ? 'togglePhd' : 'toggleMaster';
    $pickerColleges = $colleges->map(fn ($college) => [
        'id' => $college->id,
        'name' => $college->name,
    ])->values();
@endphp

<form
    class="space-y-8"
    @if($isMphil)
        x-data="preferencePicker({{ Js::from($pickerColleges) }}, {{ Js::from(array_values($selectMphilSubject)) }})"
        @submit.prevent="await $wire.set('selectMphilSubject', ranked, false); $wire.submit()"
    @else
        wire:submit="submit"
    @endif
>

    <div class="border-b border-slate-800 pb-4 space-y-1">
        <h2 class="text-xl font-bold text-slate-100">Step 4: Choose Your Preferences</h2>
        <p class="text-slate-400 text-sm">
            @if($isMphil)
                Pick specialties for <span class="text-purple-300 font-medium">{{ $seatCategoryName }}</span>, then rank them. Your 1st preference is applied first.
            @elseif($seatCategoryId > 0)
                Select one specialty for <span class="{{ $isPhd ? 'text-indigo-300' : 'text-emerald-300' }} font-medium">{{ $seatCategoryName }}</span>.
            @else
                Select your specialty preference.
            @endif
        </p>
    </div>

    @if($seatCategoryId === 0)
        <div class="flex items-center gap-4 p-6 bg-amber-500/10 border border-amber-500/30 rounded-2xl">
            <svg class="w-8 h-8 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <div>
                <p class="text-amber-300 font-semibold">No program selected</p>
                <p class="text-amber-400/70 text-xs mt-1">Please go back to Step 1 and select a seat category first.</p>
            </div>
        </div>

    @elseif($isMphil)
        {{-- Instant client-side picker: Alpine updates UI, Livewire saves on Continue --}}
        <div wire:ignore class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search available specialties..."
                        class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:bg-slate-900 transition-all text-sm">
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold">
                    <span class="px-3 py-1.5 rounded-full bg-slate-800 text-slate-300 border border-slate-700" x-text="availableTotal + ' available'"></span>
                    <span class="px-3 py-1.5 rounded-full bg-purple-500/15 text-purple-200 border border-purple-500/30" x-text="ranked.length + ' ranked'"></span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-start">
                <div class="order-2 lg:order-1 rounded-2xl border border-slate-800 bg-slate-900/40 overflow-hidden">
                    <div class="px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Available Specialties</p>
                        <p class="text-[11px] text-slate-500">Click to add</p>
                    </div>
                    <div class="p-2 max-h-[28rem] overflow-y-auto space-y-1.5">
                        <template x-for="college in available" :key="college.id">
                            <button type="button"
                                @click="add(college.name)"
                                class="group w-full flex items-center gap-3 p-3 rounded-xl border border-transparent bg-slate-950/40 hover:bg-purple-500/10 hover:border-purple-500/30 text-left transition-colors">
                                <span class="flex-shrink-0 w-8 h-8 rounded-lg border border-slate-700 bg-slate-900 text-slate-400 group-hover:border-purple-400 group-hover:text-purple-200 group-hover:bg-purple-500/20 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </span>
                                <span class="text-sm font-medium text-slate-300 group-hover:text-slate-100" x-text="college.name"></span>
                            </button>
                        </template>

                        <p x-show="availableTotal === 0" class="text-center py-10 text-slate-500 text-sm">All specialties have been added to your ranking.</p>
                        <p x-show="availableTotal > 0 && available.length === 0" class="text-center py-8 text-slate-500 text-sm">No specialties match your search.</p>
                    </div>
                </div>

                <div class="order-1 lg:order-2 rounded-2xl border border-purple-500/25 bg-purple-500/5 overflow-hidden lg:sticky lg:top-24">
                    <div class="px-4 py-3 border-b border-purple-500/20 flex items-center justify-between gap-2">
                        <div>
                            <p class="text-xs font-semibold text-purple-300 uppercase tracking-widest">Your Ranked Preferences</p>
                            <p class="text-[11px] text-slate-500 mt-0.5">Drag the handle, or use arrows to reorder</p>
                        </div>
                        <button type="button" x-show="ranked.length > 0" @click="clear()" class="text-[11px] font-semibold text-slate-400 hover:text-rose-300 transition-colors">
                            Clear all
                        </button>
                    </div>

                    <div x-show="ranked.length === 0" class="m-3 p-8 rounded-xl border border-dashed border-purple-500/20 text-center">
                        <div class="mx-auto w-10 h-10 rounded-full bg-purple-500/10 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-300">No specialties ranked yet</p>
                        <p class="text-xs text-slate-500 mt-1">Add specialties from the list. The first item becomes your highest preference.</p>
                    </div>

                    <div
                        x-show="ranked.length > 0"
                        x-sortable
                        @sorted="applySort($event.detail)"
                        class="p-2 space-y-2 max-h-[28rem] overflow-y-auto"
                    >
                        <template x-for="(subject, index) in ranked" :key="subject">
                            <div :data-id="subject" class="flex items-center gap-2 p-2.5 rounded-xl border border-purple-500/30 bg-slate-950/50">
                                <span class="drag-handle flex-shrink-0 p-1.5 rounded-lg text-slate-500 hover:text-purple-200 hover:bg-purple-500/20" title="Drag to reorder" aria-label="Drag to reorder">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 4a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm8-12a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0zm0 6a1 1 0 11-2 0 1 1 0 012 0z"/>
                                    </svg>
                                </span>

                                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-purple-600 text-white flex items-center justify-center">
                                    <span class="text-sm font-bold" x-text="index + 1"></span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] font-semibold uppercase tracking-wider text-purple-300/80" x-text="ordinal(index + 1) + ' preference'"></p>
                                    <p class="text-sm font-medium text-slate-100 truncate" x-text="subject"></p>
                                </div>

                                <div class="flex items-center gap-0.5">
                                    <button type="button" @click="moveUp(index)" :disabled="index === 0"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-slate-400"
                                        title="Move up" aria-label="Move up">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click="moveDown(index)" :disabled="index === ranked.length - 1"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-slate-400"
                                        title="Move down" aria-label="Move down">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click="remove(index)"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-rose-300 hover:bg-rose-500/10"
                                        title="Remove" aria-label="Remove">
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

            <div class="flex items-start gap-2 p-3 bg-slate-900/40 border border-slate-700/50 rounded-xl">
                <svg class="w-4 h-4 text-purple-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>
                <p class="text-xs text-slate-400">Add as many specialties as you want. Rank 1 is your first choice. You can change the order anytime before submitting.</p>
            </div>
        </div>

    @else
        {{-- PhD / Master: single selection --}}
        <div x-data="{ search: '' }" class="space-y-5">
            <div class="relative">
                <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" x-model="search" placeholder="Search specialties..."
                    class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none {{ $isPhd ? 'focus:border-indigo-500/50' : 'focus:border-emerald-500/50' }} focus:bg-slate-900 transition-all text-sm">
            </div>

            @if($selectedSingle)
                <div class="p-4 rounded-xl border {{ $isPhd ? 'bg-gradient-to-r from-indigo-500/10 to-indigo-400/5 border-indigo-500/30' : 'bg-gradient-to-r from-emerald-500/10 to-emerald-400/5 border-emerald-500/30' }}">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-8 h-8 rounded-full {{ $isPhd ? 'bg-indigo-600' : 'bg-emerald-600' }} flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wide {{ $isPhd ? 'text-indigo-300' : 'text-emerald-300' }}">Your choice</p>
                                <p class="text-sm font-medium {{ $isPhd ? 'text-indigo-100' : 'text-emerald-100' }} mt-0.5 truncate">{{ $selectedSingle }}</p>
                            </div>
                        </div>
                        <button type="button"
                            wire:click="$set('{{ $isPhd ? 'selectPhdSubject' : 'selectMasterSubject' }}', null)"
                            class="px-3 py-1 text-xs font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 rounded-lg transition-all flex-shrink-0">
                            Change
                        </button>
                    </div>
                </div>
            @endif

            <div class="space-y-2">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-1">Available Specialties</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5">
                    @forelse($colleges as $college)
                        @php $isSelected = $selectedSingle === $college->name; @endphp
                        <button type="button"
                            wire:click="{{ $toggleMethod }}({{ $college->id }})"
                            x-show="!search.trim() || $el.dataset.name.includes(search.toLowerCase())"
                            data-name="{{ strtolower($college->name) }}"
                            class="group relative overflow-hidden p-4 rounded-xl border text-left transition-all duration-200
                                {{ $isSelected
                                    ? ($isPhd ? 'border-indigo-500/60 bg-indigo-500/10 shadow-lg shadow-indigo-500/10' : 'border-emerald-500/60 bg-emerald-500/10 shadow-lg shadow-emerald-500/10')
                                    : 'border-slate-700/50 bg-slate-900/30 hover:bg-slate-900/60 hover:border-slate-600/80' }}">
                            <div class="relative flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    @if($isSelected)
                                        <div class="w-6 h-6 rounded-full {{ $isPhd ? 'bg-indigo-600' : 'bg-emerald-600' }} flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-6 h-6 rounded-full border-2 border-slate-600 group-hover:border-slate-400 transition-colors"></div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium leading-snug {{ $isSelected ? ($isPhd ? 'text-indigo-200' : 'text-emerald-200') : 'text-slate-300 group-hover:text-slate-100' }}">
                                    {{ $college->name }}
                                </span>
                            </div>
                        </button>
                    @empty
                        <p class="text-center py-8 text-slate-500 text-sm md:col-span-2">No specialties found</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    @error('preferences')
        <div class="flex items-center gap-3 p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl">
            <svg class="w-5 h-5 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <span class="text-sm text-rose-300">{{ $message }}</span>
        </div>
    @enderror

    <div class="flex justify-between pt-6 border-t border-slate-800">
        <button type="button" wire:click="back" wire:loading.attr="disabled" class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-sm font-semibold transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="submit">Continue</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
