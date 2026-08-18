<form wire:submit="submit" class="space-y-6">
    <div class="p-1"></div>
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 1: Select Seat Categories & Program</h2>
        <p class="text-slate-400 text-sm">
            @if($allowMultiple)
                You may select more than one program. Each program will have its own specialty preferences later.
            @else
                Choose one program for Postgraduate admission.
            @endif
        </p>
    </div>

    <div class="space-y-4">
        <label class="block text-sm font-semibold text-slate-200">
            Seat Category / Degree Program <span class="text-rose-500">*</span>
            @if($allowMultiple)
                <span class="ml-2 text-[11px] font-medium text-indigo-300">Multiple selection enabled</span>
            @endif
        </label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($allSeatCategories as $cat)
                @php
                    $isSelected = $allowMultiple
                        ? in_array($cat->id, array_map('intval', $selectedSeatCategories), true)
                        : (int) $selectedSeatCategory === (int) $cat->id;
                @endphp
                <label class="flex items-center space-x-3 p-4 rounded-xl border cursor-pointer transition-all
                    {{ $isSelected ? 'border-indigo-500 bg-indigo-500/10 text-slate-100' : 'border-slate-800 bg-slate-900/60 text-slate-400 hover:border-slate-700' }}">
                    @if($allowMultiple)
                        <input type="checkbox" value="{{ $cat->id }}" wire:model.live="selectedSeatCategories"
                            class="rounded text-indigo-600 focus:ring-indigo-500 bg-slate-950 border-slate-700">
                    @else
                        <input type="radio" name="seatCategory" value="{{ $cat->id }}" wire:model.live="selectedSeatCategory"
                            class="text-indigo-600 focus:ring-indigo-500 bg-slate-950 border-slate-700">
                    @endif
                    <span class="font-medium text-sm">{{ $cat->name }}</span>
                </label>
            @endforeach
        </div>
        @error('selectedSeatCategory')
            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
        @enderror
        @error('selectedSeatCategories')
            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
        @enderror
        @if($allowMultiple && count($selectedSeatCategories) > 1)
            <p class="text-xs text-slate-400">Selected programs will appear as separate tabs on the Preferences step.</p>
        @endif
    </div>

    <div class="space-y-2 pt-4 border-t border-slate-800">
        <label class="block text-sm font-semibold text-slate-200">PMDC / PNMC Registration No. <span class="text-rose-500">*</span></label>
        <input type="text" wire:model.blur="pmdcNo" placeholder="Enter your PMDC / PNMC Registration Number"
            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
            {{ $errors->has('pmdcNo') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
        @error('pmdcNo') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
    </div>
    <div class="flex justify-end pt-6 border-t border-slate-800">
        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="submit">Save & Proceed to Personal Details</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
