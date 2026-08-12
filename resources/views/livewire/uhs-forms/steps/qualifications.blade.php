<form wire:submit="submit" class="space-y-8">
    @include('livewire.partials.validation-errors')
    <div class="p-1"></div>
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 3: Academic Qualifications</h2>
        <p class="text-slate-400 text-sm">Enter your academic background details starting from Matric / SSC up to Graduation / MBBS.</p>
    </div>

    <!-- Matric / SSC Section -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">1. SSC / Matriculation / O-Level</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Exam Type</label>
                <select wire:model="sscPassed"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscPassed') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Exam</option>
                    @foreach($sscExams as $e)<option value="{{ $e->id }}">{{ $e->name }}</option>@endforeach
                </select>
                @error('sscPassed') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Board / University</label>
                <select wire:model="sscBoard"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscBoard') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Board</option>
                    @foreach($boards as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
                </select>
                @error('sscBoard') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Science Subjects</label>
                <input type="text" wire:model.blur="sscScienceSubjects" placeholder="Bio, Chem, Phys"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscScienceSubjects') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('sscScienceSubjects') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Institution Type</label>
                <select wire:model="sscInstitutionType"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscInstitutionType') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Type</option>
                    @foreach($institutionTypes as $it)<option value="{{ $it->id }}">{{ $it->name }}</option>@endforeach
                </select>
                @error('sscInstitutionType') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Passing Year</label>
                <input type="text" wire:model.blur="sscPassingYear" placeholder="2018"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscPassingYear') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('sscPassingYear') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Marks Obtained</label>
                <input type="number" wire:model.blur="sscMarksObtained"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscMarksObtained') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('sscMarksObtained') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Total Marks</label>
                <input type="number" wire:model.blur="sscTotalMarks"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('sscTotalMarks') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('sscTotalMarks') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- HSSC Section -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">2. HSSC / F.Sc / A-Level</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Exam Type</label>
                <select wire:model="hsscPassed"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscPassed') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Exam</option>
                    @foreach($hsscExams as $e)<option value="{{ $e->id }}">{{ $e->name }}</option>@endforeach
                </select>
                @error('hsscPassed') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Board / University</label>
                <select wire:model="hsscBoard"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscBoard') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Board</option>
                    @foreach($boards as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
                </select>
                @error('hsscBoard') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Subjects</label>
                <input type="text" wire:model.blur="hsscScienceSubjects" placeholder="Pre-Medical"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscScienceSubjects') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('hsscScienceSubjects') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Institution Type</label>
                <select wire:model="hsscInstitutionType"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscInstitutionType') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Type</option>
                    @foreach($institutionTypes as $it)<option value="{{ $it->id }}">{{ $it->name }}</option>@endforeach
                </select>
                @error('hsscInstitutionType') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Passing Year</label>
                <input type="text" wire:model.blur="hsscPassingYear" placeholder="2020"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscPassingYear') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('hsscPassingYear') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Marks Obtained</label>
                <input type="number" wire:model.blur="hsscMarksObtained"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscMarksObtained') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('hsscMarksObtained') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Total Marks</label>
                <input type="number" wire:model.blur="hsscTotalMarks"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('hsscTotalMarks') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('hsscTotalMarks') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- MBBS / Graduation Section -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-base font-semibold text-indigo-400 border-b border-slate-800 pb-2">3. MBBS / Graduation Degree</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Degree Title</label>
                <select wire:model="mbbsPassed"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsPassed') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Degree</option>
                    @foreach($mbbsExams as $e)<option value="{{ $e->id }}">{{ $e->name }}</option>@endforeach
                </select>
                @error('mbbsPassed') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">University</label>
                <select wire:model="mbbsBoard"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsBoard') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select University</option>
                    @foreach($boards as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
                </select>
                @error('mbbsBoard') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Specialization/Subjects</label>
                <input type="text" wire:model.blur="mbbsScienceSubjects" placeholder="Medicine / BDS"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsScienceSubjects') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('mbbsScienceSubjects') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Institution Type</label>
                <select wire:model="mbbsInstitutionType"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsInstitutionType') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Type</option>
                    @foreach($institutionTypes as $it)<option value="{{ $it->id }}">{{ $it->name }}</option>@endforeach
                </select>
                @error('mbbsInstitutionType') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Passing Year</label>
                <input type="text" wire:model.blur="mbbsPassingYear" placeholder="2024"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsPassingYear') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('mbbsPassingYear') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Marks Obtained</label>
                <input type="number" wire:model.blur="mbbsMarksObtained"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsMarksObtained') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('mbbsMarksObtained') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Total Marks</label>
                <input type="number" wire:model.blur="mbbsTotalMarks"
                    class="w-full bg-slate-950 border rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mbbsTotalMarks') ? 'border-rose-500' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('mbbsTotalMarks') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Experience Section -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-base font-semibold text-indigo-400">4. Professional Experience (Optional)</h3>
            <label class="flex items-center space-x-2 cursor-pointer text-xs text-slate-300">
                <input type="checkbox" wire:model.live="isExperience" class="rounded border-slate-700 text-indigo-600 bg-slate-950">
                <span>Add Experience Records</span>
            </label>
        </div>

        @if($isExperience)
            <div class="space-y-3">
                @foreach($experiences as $index => $exp)
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 p-3 bg-slate-950/60 rounded-xl border border-slate-800 items-end">
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1">Institute / Hospital</label>
                            <input type="text" wire:model.blur="experiences.{{ $index }}.institute"
                                class="w-full bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1">Designation</label>
                            <input type="text" wire:model.blur="experiences.{{ $index }}.designation"
                                class="w-full bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1">From Date</label>
                            <input type="date" wire:model="experiences.{{ $index }}.fromDate"
                                class="w-full bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1">To Date</label>
                            <input type="date" wire:model="experiences.{{ $index }}.toDate"
                                class="w-full bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-100 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <button type="button" wire:click="removeExperience({{ $index }})"
                                class="w-full py-1.5 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-lg text-xs font-medium hover:bg-rose-500/20">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
                <button type="button" wire:click="addExperience"
                    class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl text-xs font-semibold hover:bg-slate-700">
                    + Add Experience Row
                </button>
            </div>
        @endif
    </div>

    <div class="pt-6 flex justify-between gap-4 border-t border-slate-800">
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
            <span wire:loading.remove wire:target="submit">Save & Proceed to Admission Test</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
