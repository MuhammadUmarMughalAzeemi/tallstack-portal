<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden p-6 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-800 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-100 uppercase tracking-tight">Application Summary & Verification Status</h1>
                <p class="text-slate-400 text-sm">Review your submitted Post Graduate Admission Application details & official status.</p>
            </div>
            <div class="mt-4 md:mt-0 flex flex-wrap items-center gap-3">
                <a href="{{ route('uhs-form') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Application Details</span>
                </a>
                <button onclick="window.print()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl transition-all">
                    Print Application
                </button>
                <a href="{{ route('download.challan') }}" target="_blank" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold rounded-xl shadow-lg shadow-emerald-600/20 transition-all">
                    Download Fee Challan
                </a>
            </div>
        </div>

        <!-- Official Review Status & Fee Badge -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Official Application Status</div>
                @if($user->status == 1)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">APPROVED &check;</span>
                @elseif($user->status == 2)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30">UNDER REVIEW</span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-500/10 text-rose-400 border border-rose-500/30">REJECTED</span>
                @endif
            </div>

            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Fee Payment Status</div>
                <div class="text-base font-bold {{ $user->is_paid ? 'text-emerald-400' : 'text-amber-400' }}">
                    {{ $user->is_paid ? 'PAID & VERIFIED' : 'UNPAID / PENDING' }}
                </div>
            </div>

            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Challan No. / Application #</div>
                <div class="text-base font-mono font-bold text-slate-100">
                    #{{ $user->challan_id ?? $user->id }}
                </div>
            </div>
        </div>

        @if($user->comments)
            <div class="bg-indigo-500/10 border border-indigo-500/30 rounded-xl p-4 text-xs text-indigo-300">
                <strong>Verification Remarks:</strong> {{ $user->comments }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-slate-300">
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-2">
                <div class="flex items-center justify-between border-b border-slate-800 pb-2 mb-2">
                    <h3 class="font-bold text-indigo-400 text-sm">Personal Information</h3>
                    <a href="{{ route('uhs-form') }}" class="text-[11px] text-indigo-400 hover:underline">Edit &rarr;</a>
                </div>
                <p><span class="text-slate-500">Name:</span> <strong>{{ $user->name }}</strong></p>
                <p><span class="text-slate-500">Father's Name:</span> <strong>{{ $user->father_name }}</strong></p>
                <p><span class="text-slate-500">Mother's Name:</span> <strong>{{ $user->personalDetails?->mother_name ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">Date of Birth:</span> <strong>{{ $user->personalDetails?->date_of_birth ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">CNIC / Passport:</span> <strong>{{ $user->cnic_passport ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">PMDC / PNMC No:</span> <strong>{{ $user->pmdc_pnmc ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">Mobile:</span> <strong>{{ $user->mobile_number }}</strong></p>
                <p><span class="text-slate-500">Email:</span> <strong>{{ $user->email }}</strong></p>
                <p><span class="text-slate-500">Address:</span> <strong>{{ $user->personalDetails?->address ?? 'N/A' }}</strong></p>
            </div>

            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-2">
                <div class="flex items-center justify-between border-b border-slate-800 pb-2 mb-2">
                    <h3 class="font-bold text-indigo-400 text-sm">Academic Qualifications & Entry Test</h3>
                    <a href="{{ route('uhs-form') }}" class="text-[11px] text-indigo-400 hover:underline">Edit &rarr;</a>
                </div>
                <p><span class="text-slate-500">Matric/SSC Marks:</span> <strong>{{ $user->qualifications?->ssc_marks_obtained ?? 'N/A' }} / {{ $user->qualifications?->ssc_total_marks ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">F.Sc/HSSC Marks:</span> <strong>{{ $user->qualifications?->hssc_marks_obtained ?? 'N/A' }} / {{ $user->qualifications?->hssc_total_marks ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">Bachelor Marks:</span> <strong>{{ $user->qualifications?->mbbs_marks_obtained ?? 'N/A' }} / {{ $user->qualifications?->mbbs_total_marks ?? 'N/A' }}</strong></p>
                <p><span class="text-slate-500">M.Phil Marks:</span> <strong>{{ $user->qualifications?->mphil_marks_obtained ?? 'N/A' }} / {{ $user->qualifications?->mphil_total_marks ?? 'N/A' }}</strong></p>
                @if($user->admissionTest)
                    <p><span class="text-slate-500">MDCAT Score:</span> <strong>{{ $user->admissionTest->md_cat_obtained_marks ?? 'N/A' }}</strong></p>
                @endif
            </div>
        </div>

        <!-- Program & Subject Preferences -->
        <div class="bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-3">
            <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                <h3 class="font-bold text-indigo-400 text-sm">Program Seat Categories & Selected Subjects</h3>
                <a href="{{ route('uhs-form') }}" class="text-[11px] text-indigo-400 hover:underline">Edit Preferences &rarr;</a>
            </div>
            <div class="space-y-3 pt-2">
                @forelse($user->seatCategories as $cat)
                    <div class="space-y-2">
                        <span class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-xs rounded-lg font-medium inline-block">
                            {{ $cat->name }}
                        </span>
                        <div class="flex flex-wrap gap-2">
                            @forelse($user->mphillPhdSubjects->where('seat_category_id', $cat->id) as $index => $subj)
                                <span class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs rounded-lg font-medium">
                                    {{ $user->mphillPhdSubjects->where('seat_category_id', $cat->id)->count() > 1 ? ($index + 1) . '. ' : '' }}{{ $subj->subject }}
                                </span>
                            @empty
                                <span class="text-slate-500 italic text-xs">No specialties selected</span>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <span class="text-slate-500 italic text-xs">No program selected</span>
                @endforelse
            </div>
        </div>
    </div>
</div>
