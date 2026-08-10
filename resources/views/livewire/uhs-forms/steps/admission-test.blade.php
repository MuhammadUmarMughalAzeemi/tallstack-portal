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
                <button type="button" wire:click="$set('selectedExam', 1)" class="p-3 rounded-xl border text-xs font-bold transition-all {{ $selectedExam == 1 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    MDCAT
                </button>
                <button type="button" wire:click="$set('selectedExam', 2)" class="p-3 rounded-xl border text-xs font-bold transition-all {{ $selectedExam == 2 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    SAT (II)
                </button>
                <button type="button" wire:click="$set('selectedExam', 3)" class="p-3 rounded-xl border text-xs font-bold transition-all {{ $selectedExam == 3 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
                    UCAT
                </button>
                <button type="button" wire:click="$set('selectedExam', 4)" class="p-3 rounded-xl border text-xs font-bold transition-all {{ $selectedExam == 4 ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700' }}">
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
                        <input type="text" wire:model="mdCatCnic" placeholder="Roll No / CNIC" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        @error('mdCatCnic') <span class="text-rose-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Center <span class="text-rose-500">*</span></label>
                        <select wire:model="mdCatCenter" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                            <option value="">Select Center</option>
                            @foreach($mdcatCenters as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('mdCatCenter') <span class="text-rose-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Obtained Marks <span class="text-rose-500">*</span></label>
                        <input type="number" wire:model="mdCatObtainedMarks" placeholder="e.g. 150" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        @error('mdCatObtainedMarks') <span class="text-rose-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @elseif($selectedExam == 2)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">SAT (II) Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Biology Score (out of 800)</label>
                        <input type="number" wire:model="satBiologyMarks" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Chemistry Score (out of 800)</label>
                        <input type="number" wire:model="satChemistryMarks" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Physics/Math Score (out of 800)</label>
                        <input type="number" wire:model="satPhyMathMarks" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="satTestDate" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">College Board Username</label>
                        <input type="text" wire:model="satUsername" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">College Board Password</label>
                        <input type="password" wire:model="satPassword" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                </div>
            </div>
        @elseif($selectedExam == 3)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">UCAT Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">UCAT Candidate ID / UCAS PID</label>
                        <input type="text" wire:model="ucatCandidateId" placeholder="e.g. UKCAT123456" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Obtained Score (out of 3600)</label>
                        <input type="number" wire:model="ucatObtainedMarks" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Band Score (1-4)</label>
                        <select wire:model="ucatBand" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                            <option value="">Select Band</option>
                            <option value="1">Band 1</option>
                            <option value="2">Band 2</option>
                            <option value="3">Band 3</option>
                            <option value="4">Band 4</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="ucatTestDate" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                </div>
            </div>
        @elseif($selectedExam == 4)
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-bold text-slate-200">International MCAT Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">MCAT Score (out of 528)</label>
                        <input type="number" wire:model="mcatObtainedMarks" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Test Date</label>
                        <input type="date" wire:model="mcatTestDate" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">AAMC Username</label>
                        <input type="text" wire:model="mcatUsername" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">AAMC Password</label>
                        <input type="password" wire:model="mcatPassword" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-xs text-slate-100">
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between pt-4 border-t border-slate-800">
            <button type="button" wire:click="$dispatch('goToStep', 3)" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition-all">
                &larr; Previous Step
            </button>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all">
                Save & Continue &rarr;
            </button>
        </div>
    </form>
</div>
