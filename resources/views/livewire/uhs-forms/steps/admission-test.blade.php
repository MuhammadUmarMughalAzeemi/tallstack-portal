<div class="space-y-6">
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100 uppercase tracking-tight">Step 04: Entry / Admission Test Details</h2>
        <p class="text-xs text-slate-400">Provide your MDCAT / UCAT / MCAT / Entry Test marks and verification information.</p>
    </div>

    <form wire:submit="submit" class="space-y-6">

        <!-- Test Type Selection -->
        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Select Test Type</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button type="button" wire:click="$set('selectedExam', 1)"
                    class="p-3 rounded-xl border text-xs font-bold transition-all
                    {{ $selectedExam == 1 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    MDCAT
                </button>
                <button type="button" wire:click="$set('selectedExam', 2)"
                    class="p-3 rounded-xl border text-xs font-bold transition-all
                    {{ $selectedExam == 2 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    SAT (II)
                </button>
                <button type="button" wire:click="$set('selectedExam', 3)"
                    class="p-3 rounded-xl border text-xs font-bold transition-all
                    {{ $selectedExam == 3 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    UCAT
                </button>
                <button type="button" wire:click="$set('selectedExam', 4)"
                    class="p-3 rounded-xl border text-xs font-bold transition-all
                    {{ $selectedExam == 4 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    Int. MCAT
                </button>
            </div>
        </div>

        @if($selectedExam == 1)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">MDCAT Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">MDCAT Roll No. / CNIC <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model.blur="mdCatCnic" placeholder="Roll No / CNIC"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mdCatCnic') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mdCatCnic') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Center <span class="text-rose-500">*</span></label>
                        <select wire:model="mdCatCenter"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mdCatCenter') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                            <option value="">Select Center</option>
                            @foreach($mdcatCenters as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('mdCatCenter') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Obtained Marks <span class="text-rose-500">*</span></label>
                        <input type="number" wire:model.blur="mdCatObtainedMarks" placeholder="e.g. 150"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mdCatObtainedMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mdCatObtainedMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        @elseif($selectedExam == 2)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">SAT (II) Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Biology Score (out of 800)</label>
                        <input type="number" wire:model.blur="satBiologyMarks"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satBiologyMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satBiologyMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Chemistry Score (out of 800)</label>
                        <input type="number" wire:model.blur="satChemistryMarks"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satChemistryMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satChemistryMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Physics/Math Score (out of 800)</label>
                        <input type="number" wire:model.blur="satPhyMathMarks"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satPhyMathMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satPhyMathMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="satTestDate"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satTestDate') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satTestDate') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">College Board Username</label>
                        <input type="text" wire:model.blur="satUsername"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satUsername') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satUsername') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">College Board Password</label>
                        <input type="password" wire:model.blur="satPassword"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('satPassword') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('satPassword') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        @elseif($selectedExam == 3)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">UCAT Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">UCAT Candidate ID / UCAS PID</label>
                        <input type="text" wire:model.blur="ucatCandidateId" placeholder="e.g. UKCAT123456"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('ucatCandidateId') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('ucatCandidateId') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Obtained Score (out of 3600)</label>
                        <input type="number" wire:model.blur="ucatObtainedMarks"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('ucatObtainedMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('ucatObtainedMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Band Score (1-4)</label>
                        <select wire:model="ucatBand"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('ucatBand') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                            <option value="">Select Band</option>
                            <option value="1">Band 1</option>
                            <option value="2">Band 2</option>
                            <option value="3">Band 3</option>
                            <option value="4">Band 4</option>
                        </select>
                        @error('ucatBand') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="ucatTestDate"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('ucatTestDate') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('ucatTestDate') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        @elseif($selectedExam == 4)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">International MCAT Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">MCAT Score (out of 528)</label>
                        <input type="number" wire:model.blur="mcatObtainedMarks"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mcatObtainedMarks') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mcatObtainedMarks') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="mcatTestDate"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mcatTestDate') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mcatTestDate') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">AAMC Username</label>
                        <input type="text" wire:model.blur="mcatUsername"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mcatUsername') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mcatUsername') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">AAMC Password</label>
                        <input type="password" wire:model.blur="mcatPassword"
                            class="w-full bg-slate-900 border rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none transition-colors
                            {{ $errors->has('mcatPassword') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                        @error('mcatPassword') <span class="text-rose-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between pt-4 border-t border-slate-800">
            <button type="button" wire:click="back" wire:loading.attr="disabled"
                class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back
            </button>
            <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span wire:loading.remove wire:target="submit">Save & Continue</span>
                <span wire:loading wire:target="submit">Saving...</span>
            </button>
        </div>
    </form>
</div>
