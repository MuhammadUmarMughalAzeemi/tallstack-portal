<form wire:submit="submit" class="space-y-8">

    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-2xl font-bold text-slate-100">Step 4: Choose Your Preference</h2>
        <p class="text-slate-400 text-sm">Select your specialty for <span class="text-indigo-400 font-medium">{{ $seatCategoryName }}</span></p>
    </div>

    <!-- No Category Warning -->
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

    <!-- PhD Single Selection -->
    @elseif($seatCategoryId === 1)
        <div class="space-y-6">
            <!-- Search Bar -->
            <div x-data="{ search: '' }" class="space-y-6">
                <div class="relative">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search specialties..." class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:border-indigo-500/50 focus:bg-slate-900 transition-all text-sm">
                </div>

                <!-- Selected Item -->
                @if($selectPhdSubject)
                    <div class="p-4 bg-gradient-to-r from-indigo-500/10 to-indigo-400/5 border border-indigo-500/30 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-indigo-300 uppercase tracking-wide">Your Choice</p>
                                    <p class="text-sm font-medium text-indigo-100 mt-0.5">{{ $selectPhdSubject }}</p>
                                </div>
                            </div>
                            <button type="button" wire:click="$set('selectPhdSubject', null)" class="px-3 py-1 text-xs font-medium text-slate-400 hover:text-slate-300 hover:bg-slate-800/50 rounded-lg transition-all">
                                Change
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Specialties Grid - Aesthetic Cards -->
                <div class="space-y-2.5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-1">Available Specialties</p>
                    <div class="grid grid-cols-1 gap-2.5">
                        @foreach($colleges as $college)
                            <button type="button"
                                x-show="search.trim() === '' || '{{ strtolower($college->name) }}'.includes(search.toLowerCase())"
                                wire:click="$set('selectPhdSubject', '{{ $selectPhdSubject === $college->name ? '' : $college->name }}')"
                                class="group relative overflow-hidden p-4 rounded-xl border border-slate-700/50 bg-slate-900/30 hover:bg-slate-900/60 transition-all duration-200 text-left
                                    {{ $selectPhdSubject === $college->name ? 'border-indigo-500/60 bg-indigo-500/10 shadow-lg shadow-indigo-500/10' : 'hover:border-slate-600/80' }}">
                                
                                <!-- Gradient background effect on hover -->
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/0 to-indigo-600/0 group-hover:from-indigo-600/5 group-hover:to-indigo-600/0 transition-all duration-300 pointer-events-none"></div>

                                <!-- Content -->
                                <div class="relative flex items-center gap-3">
                                    <!-- Check Icon -->
                                    <div class="flex-shrink-0">
                                        @if($selectPhdSubject === $college->name)
                                            <div class="w-6 h-6 rounded-full bg-indigo-600 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border-2 border-slate-600 group-hover:border-slate-500 transition-colors"></div>
                                        @endif
                                    </div>

                                    <!-- Name -->
                                    <span class="text-sm font-medium leading-snug text-slate-300 group-hover:text-slate-100 transition-colors
                                        {{ $selectPhdSubject === $college->name ? '!text-indigo-200' : '' }}">
                                        {{ $college->name }}
                                    </span>
                                </div>
                            </button>
                        @endforeach

                        @if($colleges->isEmpty())
                            <p class="text-center py-8 text-slate-500 text-sm">No specialties found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    <!-- MPhil Multiple Selection with Ranking -->
    @elseif($seatCategoryId === 2)
        <div class="space-y-6">
            <div x-data="{ search: '' }" class="space-y-6">
                <!-- Search Bar -->
                <div class="relative">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search specialties..." class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:bg-slate-900 transition-all text-sm">
                </div>

                <!-- Selected Items - Ranked Badges -->
                @if(count($selectMphilSubject) > 0)
                    <div class="space-y-2">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-1">Your Ranked Preferences ({{ count($selectMphilSubject) }})</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($selectMphilSubject as $i => $subject)
                                <div class="inline-flex items-center gap-2 px-3 py-2 bg-gradient-to-r from-purple-500/20 to-purple-600/10 border border-purple-500/40 rounded-full group hover:border-purple-500/60 transition-all">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-purple-600 text-white text-xs font-bold">{{ $i + 1 }}</span>
                                    <span class="text-xs font-medium text-purple-200 max-w-[200px] truncate">{{ $subject }}</span>
                                    <button type="button" 
                                        wire:click="$set('selectMphilSubject', {{ json_encode(array_values(array_diff($selectMphilSubject, [$subject]))) }})"
                                        class="ml-1 text-purple-400 hover:text-purple-300 opacity-0 group-hover:opacity-100 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" wire:click="$set('selectMphilSubject', [])" class="text-xs font-medium text-slate-500 hover:text-slate-400 transition-colors">
                            Clear All
                        </button>
                    </div>
                @endif

                <!-- Specialties Grid -->
                <div class="space-y-2.5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-1">Available Specialties</p>
                    <div class="grid grid-cols-1 gap-2.5">
                        @foreach($colleges as $college)
                            @php
                                $pos = array_search($college->name, $selectMphilSubject);
                                $isSelected = $pos !== false;
                                $rank = $isSelected ? $pos + 1 : null;
                                $newList = $isSelected
                                    ? json_encode(array_values(array_diff($selectMphilSubject, [$college->name])))
                                    : json_encode(array_values(array_merge($selectMphilSubject, [$college->name])));
                            @endphp
                            <button type="button"
                                x-show="search.trim() === '' || '{{ strtolower($college->name) }}'.includes(search.toLowerCase())"
                                wire:click="$set('selectMphilSubject', {{ $newList }})"
                                class="group relative overflow-hidden p-4 rounded-xl border border-slate-700/50 bg-slate-900/30 hover:bg-slate-900/60 transition-all duration-200 text-left
                                    {{ $isSelected ? 'border-purple-500/60 bg-purple-500/10 shadow-lg shadow-purple-500/10' : 'hover:border-slate-600/80' }}">
                                
                                <!-- Gradient background effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 to-purple-600/0 group-hover:from-purple-600/5 group-hover:to-purple-600/0 transition-all duration-300 pointer-events-none"></div>

                                <!-- Content -->
                                <div class="relative flex items-center gap-3">
                                    <!-- Rank Badge -->
                                    <div class="flex-shrink-0">
                                        @if($isSelected)
                                            <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center font-bold text-white text-sm">
                                                {{ $rank }}
                                            </div>
                                        @else
                                            <div class="w-8 h-8 rounded-full border-2 border-slate-600 group-hover:border-slate-500 transition-colors flex items-center justify-center">
                                                <svg class="w-4 h-4 text-slate-500 group-hover:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Name -->
                                    <span class="text-sm font-medium leading-snug text-slate-300 group-hover:text-slate-100 transition-colors
                                        {{ $isSelected ? '!text-purple-200' : '' }}">
                                        {{ $college->name }}
                                    </span>
                                </div>
                            </button>
                        @endforeach

                        @if($colleges->isEmpty())
                            <p class="text-center py-8 text-slate-500 text-sm">No specialties found</p>
                        @endif
                    </div>
                </div>

                <!-- Helper Text -->
                <div class="p-3 bg-slate-900/40 border border-slate-700/50 rounded-lg">
                    <p class="text-xs text-slate-500 flex items-center gap-2">
                        <span class="text-xs">💡</span>
                        Click to add specialties. Numbers show your priority order. Your ranking can be changed anytime.
                    </p>
                </div>
            </div>
        </div>

    <!-- Master Single Selection -->
    @elseif($seatCategoryId === 3)
        <div class="space-y-6">
            <div x-data="{ search: '' }" class="space-y-6">
                <!-- Search Bar -->
                <div class="relative">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search specialties..." class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 focus:bg-slate-900 transition-all text-sm">
                </div>

                <!-- Selected Item -->
                @if($selectMasterSubject)
                    <div class="p-4 bg-gradient-to-r from-emerald-500/10 to-emerald-400/5 border border-emerald-500/30 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-emerald-300 uppercase tracking-wide">Your Choice</p>
                                    <p class="text-sm font-medium text-emerald-100 mt-0.5">{{ $selectMasterSubject }}</p>
                                </div>
                            </div>
                            <button type="button" wire:click="$set('selectMasterSubject', null)" class="px-3 py-1 text-xs font-medium text-slate-400 hover:text-slate-300 hover:bg-slate-800/50 rounded-lg transition-all">
                                Change
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Specialties Grid -->
                <div class="space-y-2.5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-1">Available Specialties</p>
                    <div class="grid grid-cols-1 gap-2.5">
                        @foreach($colleges as $college)
                            <button type="button"
                                x-show="search.trim() === '' || '{{ strtolower($college->name) }}'.includes(search.toLowerCase())"
                                wire:click="$set('selectMasterSubject', '{{ $selectMasterSubject === $college->name ? '' : $college->name }}')"
                                class="group relative overflow-hidden p-4 rounded-xl border border-slate-700/50 bg-slate-900/30 hover:bg-slate-900/60 transition-all duration-200 text-left
                                    {{ $selectMasterSubject === $college->name ? 'border-emerald-500/60 bg-emerald-500/10 shadow-lg shadow-emerald-500/10' : 'hover:border-slate-600/80' }}">
                                
                                <!-- Gradient background effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/0 to-emerald-600/0 group-hover:from-emerald-600/5 group-hover:to-emerald-600/0 transition-all duration-300 pointer-events-none"></div>

                                <!-- Content -->
                                <div class="relative flex items-center gap-3">
                                    <!-- Check Icon -->
                                    <div class="flex-shrink-0">
                                        @if($selectMasterSubject === $college->name)
                                            <div class="w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border-2 border-slate-600 group-hover:border-slate-500 transition-colors"></div>
                                        @endif
                                    </div>

                                    <!-- Name -->
                                    <span class="text-sm font-medium leading-snug text-slate-300 group-hover:text-slate-100 transition-colors
                                        {{ $selectMasterSubject === $college->name ? '!text-emerald-200' : '' }}">
                                        {{ $college->name }}
                                    </span>
                                </div>
                            </button>
                        @endforeach

                        @if($colleges->isEmpty())
                            <p class="text-center py-8 text-slate-500 text-sm">No specialties found</p>
                        @endif
                    </div>
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

    <!-- Navigation -->
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
