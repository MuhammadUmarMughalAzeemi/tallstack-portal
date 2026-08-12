<form wire:submit="submit" class="space-y-6">
    @include('livewire.partials.validation-errors')
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 5: Subject & Department Preferences</h2>
        <p class="text-slate-400 text-sm">Select your desired subjects and specialty choices for Postgraduate programs.</p>
    </div>

    <!-- M.Phil Preferences -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">M.Phil Specialty Choices</h3>
        <p class="text-xs text-slate-400">Select one or more M.Phil disciplines you wish to apply for:</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @foreach($mphilColleges as $college)
                <label class="flex items-center space-x-3 p-3 rounded-xl border cursor-pointer transition-all
                    {{ in_array($college->name, (array) $selectMphilSubject)
                        ? 'border-indigo-500 bg-indigo-500/10 text-slate-100'
                        : 'border-slate-800 bg-slate-950 text-slate-400 hover:border-slate-700' }}">
                    <input type="checkbox" value="{{ $college->name }}" wire:model="selectMphilSubject"
                        class="rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950">
                    <span class="text-xs font-medium">{{ $college->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Ph.D Preferences -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">Ph.D Specialty Choice</h3>
        <select wire:model="selectPhdSubject"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            <option value="">Select Ph.D Specialty (If applicable)</option>
            @foreach($phdColleges as $college)
                <option value="{{ $college->name }}">{{ $college->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Training Programs Section -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">Institutes & Training Centers</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @foreach($trainingPrograms as $tp)
                <label class="flex items-center space-x-3 p-3 rounded-xl border cursor-pointer transition-all
                    {{ in_array($tp->name, $selectTrainingPrograms)
                        ? 'border-indigo-500 bg-indigo-500/10 text-slate-100'
                        : 'border-slate-800 bg-slate-950 text-slate-400 hover:border-slate-700' }}">
                    <input type="checkbox" value="{{ $tp->name }}" wire:model="selectTrainingPrograms"
                        class="rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950">
                    <span class="text-xs font-medium">{{ $tp->name }} ({{ $tp->program_name }})</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="space-y-4">
        @error('preferences')
            <span class="text-xs text-rose-400 block p-3 bg-rose-500/10 border border-rose-500/30 rounded-xl">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-between pt-6 border-t border-slate-800">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="submit">Save & Proceed to Documents Upload</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
