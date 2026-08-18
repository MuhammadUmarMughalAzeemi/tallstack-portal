<div class="space-y-6">
    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
        <div>
            <h2 class="text-xl font-bold text-slate-100 uppercase tracking-tight">Step 6: Review Application Summary</h2>
            <p class="text-xs text-slate-400">Review your information before final submission. Click "Edit" on any section to modify your details.</p>
        </div>
        <div class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 rounded-full text-xs font-bold">
            Pre-Submission Audit
        </div>
    </div>

    <!-- Personal Details Section -->
    <div class="bg-slate-950/80 border border-slate-800 rounded-2xl p-5 space-y-3 relative group hover:border-slate-700 transition-all">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-sm font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Personal Information</span>
            </h3>
            <button type="button" wire:click="editStep(2)" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Details</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-300">
            <div><span class="text-slate-500 block">Candidate Name</span> <strong class="text-slate-100 text-sm">{{ $user->name }}</strong></div>
            <div><span class="text-slate-500 block">Father's Name</span> <strong class="text-slate-100 text-sm">{{ $user->father_name }}</strong></div>
            <div><span class="text-slate-500 block">Mother's Name</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->mother_name ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">Date of Birth</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->date_of_birth ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">Mobile Number</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->mobile_number ?? $user->mobile_number }}</strong></div>
            <div><span class="text-slate-500 block">Email Address</span> <strong class="text-slate-100 text-sm">{{ $user->email }}</strong></div>
            <div><span class="text-slate-500 block">CNIC / Passport</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->cnic_passport ?? $user->cnic_passport }}</strong></div>
            <div><span class="text-slate-500 block">City / Domicile</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->city ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">Address</span> <strong class="text-slate-100 text-sm">{{ $personalDetails->address ?? 'N/A' }}</strong></div>
        </div>
    </div>

    <!-- Seat Categories & PMDC Section -->
    <div class="bg-slate-950/80 border border-slate-800 rounded-2xl p-5 space-y-3 relative group hover:border-slate-700 transition-all">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-sm font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <span>Program & Seat Categories</span>
            </h3>
            <button type="button" wire:click="editStep(1)" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Categories</span>
            </button>
        </div>
        <div class="flex flex-wrap gap-2 py-1">
            @forelse($seatCategories as $cat)
                <span class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 rounded-full text-xs font-semibold">{{ is_string($cat) ? $cat : $cat->name }}</span>
            @empty
                <span class="text-slate-500 italic">No seat category selected.</span>
            @endforelse
        </div>
        <div class="text-xs text-slate-400 pt-2 border-t border-slate-900"><span class="text-slate-500">PMDC/PNMC Reg No:</span> <strong class="text-slate-100 text-sm">{{ $user->pmdc_pnmc ?? 'N/A' }}</strong></div>
    </div>

    <!-- Qualifications Section -->
    <div class="bg-slate-950/80 border border-slate-800 rounded-2xl p-5 space-y-3 relative group hover:border-slate-700 transition-all">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-sm font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                <span>Academic Qualifications</span>
            </h3>
            <button type="button" wire:click="editStep(3)" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Qualifications</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs text-slate-300">
            <div><span class="text-slate-500 block">SSC Marks</span> <strong class="text-slate-100 text-sm">{{ $qualifications->ssc_marks_obtained ?? 'N/A' }} / {{ $qualifications->ssc_total_marks ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">HSSC Marks</span> <strong class="text-slate-100 text-sm">{{ $qualifications->hssc_marks_obtained ?? 'N/A' }} / {{ $qualifications->hssc_total_marks ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">MBBS Marks</span> <strong class="text-slate-100 text-sm">{{ $qualifications->mbbs_marks_obtained ?? 'N/A' }} / {{ $qualifications->mbbs_total_marks ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">M.Phil Marks</span> <strong class="text-slate-100 text-sm">{{ $qualifications->mphil_marks_obtained ?? 'N/A' }} / {{ $qualifications->mphil_total_marks ?? 'N/A' }}</strong></div>
        </div>
    </div>

    <!-- Admission Test Section -->
    <div class="bg-slate-950/80 border border-slate-800 rounded-2xl p-5 space-y-3 relative group hover:border-slate-700 transition-all">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-sm font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Admission / Entry Test</span>
            </h3>
            <button type="button" wire:click="editStep(4)" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Test Details</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-300">
            <div><span class="text-slate-500 block">MDCAT Obtained Marks</span> <strong class="text-slate-100 text-sm">{{ $admissionTest->md_cat_obtained_marks ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">MDCAT Roll No.</span> <strong class="text-slate-100 text-sm">{{ $admissionTest->md_cat_cnic ?? 'N/A' }}</strong></div>
            <div><span class="text-slate-500 block">UCAT / Int. MCAT</span> <strong class="text-slate-100 text-sm">{{ $admissionTest->ucat_obtained_marks ?? $admissionTest->mcat_obtained_marks ?? 'N/A' }}</strong></div>
        </div>
    </div>

    <!-- Subject Preferences Section -->
    <div class="bg-slate-950/80 border border-slate-800 rounded-2xl p-5 space-y-3 relative group hover:border-slate-700 transition-all">
        <div class="flex items-center justify-between border-b border-slate-800 pb-2">
            <h3 class="text-sm font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>Selected Specialty Subjects</span>
            </h3>
            <button type="button" wire:click="editStep(5)" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Preferences</span>
            </button>
        </div>
        <div class="space-y-3 py-1">
            @forelse($seatCategories as $cat)
                @php
                    $programSubjects = $mphillPhdSubjects->where('seat_category_id', $cat->id ?? null);
                @endphp
                <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-3 space-y-2">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-indigo-300">{{ $cat->name }}</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse($programSubjects as $index => $sub)
                            <span class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 rounded-full text-xs font-semibold">
                                {{ $programSubjects->count() > 1 ? ($index + 1) . '. ' : '' }}{{ $sub->subject }}
                            </span>
                        @empty
                            <span class="text-slate-500 italic text-xs">No specialties selected for this program.</span>
                        @endforelse
                    </div>
                </div>
            @empty
                <span class="text-slate-500 italic">No subject preferences recorded yet.</span>
            @endforelse
        </div>
    </div>

    <!-- Final Submission Action -->
    <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950/40 border border-indigo-500/30 rounded-2xl p-6 space-y-4 shadow-2xl">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 flex-shrink-0 bg-emerald-500/20 rounded-xl flex items-center justify-center border border-emerald-500/30">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-100">Ready for Final Submission</h4>
                <p class="text-xs text-slate-400 mt-0.5 leading-relaxed">
                    By clicking "Proceed to Final Declaration", you will be guided to sign the final undertaking and submit your application.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-slate-800">
            <div class="flex items-center gap-2">
                <x-button wire:click="back" color="slate" flat class="h-10 px-4 rounded-xl font-black uppercase tracking-widest text-[10px]" left-icon="arrow-left">Back</x-button>
                <button type="button" wire:click="editStep(6)" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition-all flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Edit Uploaded Documents</span>
                </button>
            </div>

            <button type="button" wire:click="editStep(8)" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black uppercase tracking-wider rounded-xl shadow-lg shadow-emerald-600/30 transition-all flex items-center space-x-2">
                <span>Proceed to Final Declaration</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>
</div>
