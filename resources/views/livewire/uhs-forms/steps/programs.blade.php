<form wire:submit="submit" class="space-y-6">
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 1: Select Seat Categories & Program</h2>
        <p class="text-slate-400 text-sm">Choose your desired program and seat categories for Postgraduate admission.</p>
    </div>

    <div class="space-y-4">
        <label class="block text-sm font-semibold text-slate-200">Seat Category / Degree Program <span class="text-rose-500">*</span></label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($allSeatCategories as $cat)
                <label class="flex items-center space-x-3 p-4 rounded-xl border cursor-pointer transition-all {{ in_array($cat->id, $seatCategories) ? 'border-indigo-500 bg-indigo-500/10 text-slate-100' : 'border-slate-800 bg-slate-900/60 text-slate-400 hover:border-slate-700' }}">
                    <input type="checkbox" value="{{ $cat->id }}" wire:model.live="seatCategories" class="rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950">
                    <span class="font-medium text-sm">{{ $cat->name }}</span>
                </label>
            @endforeach
        </div>
        @error('seatCategories') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
    </div>

    <div class="space-y-2 pt-4 border-t border-slate-800">
        <label class="block text-sm font-semibold text-slate-200">PMDC / PNMC Registration No. <span class="text-rose-500">*</span></label>
        <input type="text" wire:model="pmdcNo" placeholder="Enter your PMDC / PNMC Registration Number" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
        @error('pmdcNo') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
    </div>

    <div class="space-y-4 pt-4 border-t border-slate-800">
        <label class="block text-sm font-semibold text-slate-200">Applicant Status</label>
        <div class="flex items-center space-x-6">
            <label class="flex items-center space-x-2 text-slate-300 text-sm cursor-pointer">
                <input type="radio" value="0" wire:model.live="foreigner" class="text-indigo-600 focus:ring-indigo-500 bg-slate-950 border-slate-800">
                <span>Pakistani National</span>
            </label>
            <label class="flex items-center space-x-2 text-slate-300 text-sm cursor-pointer">
                <input type="radio" value="1" wire:model.live="foreigner" class="text-indigo-600 focus:ring-indigo-500 bg-slate-950 border-slate-800">
                <span>Foreign National / Overseas</span>
            </label>
        </div>
    </div>

    <div class="space-y-4 pt-4 border-t border-slate-800">
        <label class="flex items-start space-x-3 cursor-pointer">
            <input type="checkbox" value="1" wire:model.live="affirmation" class="mt-1 rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950">
            <span class="text-xs text-slate-300 leading-relaxed">
                I hereby declare that all information provided in this admission form is true, correct, and complete to the best of my knowledge and belief.
            </span>
        </label>
        @error('affirmation') <span class="text-xs text-rose-400 block">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end pt-6 border-t border-slate-800">
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-2">
            <span>Save & Proceed to Personal Details</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</form>
