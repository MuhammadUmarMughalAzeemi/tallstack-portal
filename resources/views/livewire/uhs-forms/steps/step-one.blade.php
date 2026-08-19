<div class="space-y-4 font-sans select-none-print w-full" x-data="{
    init() {
        // Block Ctrl+P and Cmd+P printing
        window.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.keyCode === 80)) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        });
        window.addEventListener('beforeprint', (e) => {
            e.preventDefault();
            return false;
        });
    }
}">

    <style>
        /* Block and disable print output */
        @media print {
            html, body {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                overflow: hidden !important;
            }
        }
    </style>

    <!-- Top Compact Header Banner -->
    <div class="bg-slate-900/80 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl px-5 py-3.5 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 flex-shrink-0">
                    Step 6 of 7
                </span>
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-100 light:text-slate-900 leading-tight">Review Application Summary</h2>
                    <p class="text-xs text-slate-400 light:text-slate-600">Please review all submitted details before final declaration. Click "Edit" on any section to make changes.</p>
                </div>
            </div>
            <div class="self-start sm:self-auto flex-shrink-0">
                <span class="px-3 py-1 rounded-xl bg-slate-950/60 light:bg-slate-100 border border-slate-800 light:border-slate-300 text-xs font-mono font-bold text-slate-200 light:text-slate-800 block">
                    App #{{ $user->id }}
                </span>
            </div>
        </div>
    </div>

    <!-- Main Two-Column Split Layout (Full Width & Minimal Scroll) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-start w-full">

        <!-- ================================================================= -->
        <!-- LEFT COLUMN (4 of 12 Cols): Compact Sticky Profile Sidebar        -->
        <!-- ================================================================= -->
        <div class="lg:col-span-4 bg-slate-900/70 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl p-4 space-y-4 lg:sticky lg:top-20 shadow-sm">
            
            <!-- Passport Photo & Core Identity -->
            <div class="flex flex-col items-center text-center space-y-2.5 pb-3.5 border-b border-slate-800/60 light:border-slate-200">
                <!-- Candidate Photo (Full Circle, No Border) -->
                <div class="w-24 h-24 rounded-full overflow-hidden bg-slate-950 light:bg-slate-100 flex items-center justify-center cursor-pointer shadow-md hover:scale-105 transition-all"
                     @if(!empty($documents['photo']['url'])) onclick="window.openDocModal('{{ $documents['photo']['url'] }}', 'Passport Size Photo')" @endif>
                    @if(!empty($documents['photo']['url']))
                        <img src="{{ $documents['photo']['url'] }}" alt="Passport Photo" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-slate-400 light:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>

                <!-- Candidate Name & Relation -->
                <div class="space-y-0.5">
                    <h3 class="text-base font-bold text-slate-100 light:text-slate-900 leading-snug">{{ $user->name }}</h3>
                    <p class="text-[11px] text-slate-400 light:text-slate-600">S/D/W of <span class="font-semibold text-slate-200 light:text-slate-800">{{ $user->father_name ?? 'N/A' }}</span></p>
                </div>

                <!-- Identity Badges -->
                <div class="flex flex-wrap items-center justify-center gap-1.5 pt-0.5">
                    <span class="px-2 py-0.5 rounded-md bg-slate-950/60 light:bg-slate-100 border border-slate-800 light:border-slate-200 text-[11px] font-mono font-bold text-slate-200 light:text-slate-800">
                        CNIC: {{ $user->cnic_passport ?? $personalDetails?->cnic_passport ?? 'N/A' }}
                    </span>
                    @if($user->pmdc_pnmc)
                        <span class="px-2 py-0.5 rounded-md bg-indigo-500/10 light:bg-indigo-50 border border-indigo-500/20 light:border-indigo-200 text-[11px] font-semibold text-indigo-300 light:text-indigo-800">
                            PMDC: {{ $user->pmdc_pnmc }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Structured Profile Attributes -->
            <div class="space-y-1.5 text-xs">
                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Mother's Name</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails->mother_name ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Date of Birth</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">
                        {{ !empty($personalDetails?->date_of_birth) ? \Carbon\Carbon::parse($personalDetails->date_of_birth)->format('d M, Y') : 'N/A' }}
                        @if(!empty($personalDetails?->date_of_birth))
                            <span class="text-slate-400 font-normal">({{ \Carbon\Carbon::parse($personalDetails->date_of_birth)->age }}y)</span>
                        @endif
                    </span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Gender / Nationality</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails?->gender?->name ?? 'N/A' }} / {{ $personalDetails?->nationality?->name ?? 'Pakistani' }}</span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Mobile Number</span>
                    <span class="font-mono font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails->mobile_number ?? $user->mobile_number ?? 'N/A' }}</span>
                </div>

                @if(!empty($personalDetails->secondary_number) || !empty($personalDetails->telephone_number))
                    <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                        <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Secondary Contact</span>
                        <span class="font-mono font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails->secondary_number ?? $personalDetails->telephone_number }}</span>
                    </div>
                @endif

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Email Address</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px] truncate max-w-[150px]" title="{{ $user->email }}">{{ $user->email }}</span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">District / Domicile</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails?->district?->name ?? $personalDetails?->city ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">Residence Area</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails?->area?->name ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between py-1 border-b border-slate-800/40 light:border-slate-200">
                    <span class="text-slate-400 light:text-slate-500 font-medium text-[11px]">City / Country</span>
                    <span class="font-semibold text-slate-200 light:text-slate-800 text-right text-[11px]">{{ $personalDetails->city ?? 'N/A' }} / {{ $personalDetails->country ?? 'Pakistan' }}</span>
                </div>

                <div class="pt-1">
                    <span class="text-slate-400 light:text-slate-500 font-medium block text-[10px] uppercase mb-0.5">Permanent Address</span>
                    <p class="font-medium text-slate-200 light:text-slate-800 leading-snug text-[11px] bg-slate-950/40 light:bg-slate-50 p-2 rounded-lg border border-slate-800/60 light:border-slate-200">{{ $personalDetails->address ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Edit Personal Info Button -->
            <button type="button" wire:click="editStep(2)" class="w-full py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 light:bg-slate-100 light:hover:bg-slate-200 text-indigo-400 light:text-indigo-700 text-xs font-bold transition-colors flex items-center justify-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Personal Details</span>
            </button>
        </div>

        <!-- ================================================================= -->
        <!-- RIGHT COLUMN (8 of 12 Cols): Application Modules & Details        -->
        <!-- ================================================================= -->
        <div class="lg:col-span-8 space-y-4">

            <!-- 1. Seat Categories Module (Compact Bar) -->
            <div class="bg-slate-900/60 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl p-3.5 shadow-sm">
                <div class="flex items-center justify-between pb-2 border-b border-slate-800/50 light:border-slate-200">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 light:bg-emerald-600"></span>
                        <h4 class="text-xs font-bold text-slate-100 light:text-slate-900 uppercase tracking-wider">Applied Seat Categories</h4>
                    </div>
                    <button type="button" wire:click="editStep(1)" class="px-2.5 py-0.5 rounded-lg bg-slate-800 hover:bg-slate-700 light:bg-slate-200 text-indigo-400 light:text-indigo-700 text-xs font-bold transition-colors">
                        Edit
                    </button>
                </div>
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    @forelse($seatCategories as $cat)
                        <div class="px-3 py-1 rounded-xl bg-slate-950/60 light:bg-slate-50 border border-slate-800 light:border-slate-200 text-xs font-bold text-slate-200 light:text-slate-800 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>{{ is_string($cat) ? $cat : $cat->name }}</span>
                        </div>
                    @empty
                        <span class="text-slate-500 text-xs italic">No category selected.</span>
                    @endforelse
                </div>
            </div>

            <!-- 2. Academic Qualifications (Enhanced Modern Credential Cards) -->
            <div class="bg-slate-900/60 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-800/50 light:border-slate-200">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400 light:bg-amber-600"></span>
                        <h4 class="text-xs font-bold text-slate-100 light:text-slate-900 uppercase tracking-wider">Academic Qualifications</h4>
                    </div>
                    <button type="button" wire:click="editStep(3)" class="px-2.5 py-0.5 rounded-lg bg-slate-800 hover:bg-slate-700 light:bg-slate-200 text-indigo-400 light:text-indigo-700 text-xs font-bold transition-colors">
                        Edit Qualifications
                    </button>
                </div>

                <!-- Modern Degree Credential Cards Grid (2x2 / Responsive) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    
                    <!-- 1. Matric / SSC Tile -->
                    <div class="p-3 rounded-xl bg-slate-950/50 light:bg-slate-50 border border-slate-800/80 light:border-slate-200 space-y-2 hover:border-indigo-500/40 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-md bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 font-mono font-bold text-[10px] flex items-center justify-center">01</span>
                                <span class="text-xs font-bold text-slate-100 light:text-slate-900">Matric / SSC</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-md bg-slate-900 light:bg-white text-slate-300 light:text-slate-700 border border-slate-800 light:border-slate-200 text-[10px] font-mono font-bold">
                                {{ $qualifications?->ssc_passing_year ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="text-[11px] text-slate-300 light:text-slate-700 space-y-0.5">
                            <div class="font-semibold text-slate-200 light:text-slate-800 truncate" title="{{ $qualifications?->sscExam?->name }}">
                                {{ $qualifications?->sscExam?->name ?? 'Matriculation' }} ({{ $qualifications?->ssc_science_subjects ?? 'Science' }})
                            </div>
                            <div class="text-[10px] text-slate-400 light:text-slate-500 truncate" title="{{ $qualifications?->sscBoard?->name }}">
                                {{ $qualifications?->sscBoard?->name ?? 'Board' }}
                            </div>
                        </div>

                        <div class="pt-1.5 border-t border-slate-800/40 light:border-slate-200 flex items-center justify-between text-[11px]">
                            <span class="font-mono font-bold text-slate-100 light:text-slate-900 text-xs">
                                {{ $qualifications?->ssc_marks_obtained ?? 'N/A' }} / {{ $qualifications?->ssc_total_marks ?? 'N/A' }}
                            </span>
                            @if(!empty($qualifications?->ssc_marks_obtained) && !empty($qualifications?->ssc_total_marks) && $qualifications->ssc_total_marks > 0)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-400 light:bg-emerald-100 light:text-emerald-800">
                                    {{ round(($qualifications->ssc_marks_obtained / $qualifications->ssc_total_marks) * 100, 2) }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- 2. F.Sc / HSSC Tile -->
                    <div class="p-3 rounded-xl bg-slate-950/50 light:bg-slate-50 border border-slate-800/80 light:border-slate-200 space-y-2 hover:border-indigo-500/40 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-md bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 font-mono font-bold text-[10px] flex items-center justify-center">02</span>
                                <span class="text-xs font-bold text-slate-100 light:text-slate-900">F.Sc / HSSC</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-md bg-slate-900 light:bg-white text-slate-300 light:text-slate-700 border border-slate-800 light:border-slate-200 text-[10px] font-mono font-bold">
                                {{ $qualifications?->hssc_passing_year ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="text-[11px] text-slate-300 light:text-slate-700 space-y-0.5">
                            <div class="font-semibold text-slate-200 light:text-slate-800 truncate" title="{{ $qualifications?->hsscExam?->name }}">
                                {{ $qualifications?->hsscExam?->name ?? 'Intermediate' }} ({{ $qualifications?->hssc_science_subjects ?? 'Pre-Medical' }})
                            </div>
                            <div class="text-[10px] text-slate-400 light:text-slate-500 truncate" title="{{ $qualifications?->hsscBoard?->name }}">
                                {{ $qualifications?->hsscBoard?->name ?? 'Board' }}
                            </div>
                        </div>

                        <div class="pt-1.5 border-t border-slate-800/40 light:border-slate-200 flex items-center justify-between text-[11px]">
                            <span class="font-mono font-bold text-slate-100 light:text-slate-900 text-xs">
                                {{ $qualifications?->hssc_marks_obtained ?? 'N/A' }} / {{ $qualifications?->hssc_total_marks ?? 'N/A' }}
                            </span>
                            @if(!empty($qualifications?->hssc_marks_obtained) && !empty($qualifications?->hssc_total_marks) && $qualifications->hssc_total_marks > 0)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-400 light:bg-emerald-100 light:text-emerald-800">
                                    {{ round(($qualifications->hssc_marks_obtained / $qualifications->hssc_total_marks) * 100, 2) }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- 3. Bachelor's / MBBS Tile -->
                    <div class="p-3 rounded-xl bg-slate-950/50 light:bg-slate-50 border border-slate-800/80 light:border-slate-200 space-y-2 hover:border-indigo-500/40 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-md bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 font-mono font-bold text-[10px] flex items-center justify-center">03</span>
                                <span class="text-xs font-bold text-slate-100 light:text-slate-900">Bachelor's / MBBS</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-md bg-slate-900 light:bg-white text-slate-300 light:text-slate-700 border border-slate-800 light:border-slate-200 text-[10px] font-mono font-bold">
                                {{ $qualifications?->mbbs_passing_year ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="text-[11px] text-slate-300 light:text-slate-700 space-y-0.5">
                            <div class="font-semibold text-slate-200 light:text-slate-800 truncate" title="{{ $qualifications?->mbbsExam?->name }}">
                                {{ $qualifications?->mbbsExam?->name ?? 'MBBS / BDS' }} ({{ $qualifications?->mbbs_science_subjects ?? 'Medicine' }})
                            </div>
                            <div class="text-[10px] text-slate-400 light:text-slate-500 truncate" title="{{ $qualifications?->mbbsBoard?->name }}">
                                {{ $qualifications?->mbbsBoard?->name ?? 'University' }}
                            </div>
                        </div>

                        <div class="pt-1.5 border-t border-slate-800/40 light:border-slate-200 flex items-center justify-between text-[11px]">
                            <span class="font-mono font-bold text-slate-100 light:text-slate-900 text-xs">
                                {{ $qualifications?->mbbs_marks_obtained ?? 'N/A' }} / {{ $qualifications?->mbbs_total_marks ?? 'N/A' }}
                            </span>
                            @if(!empty($qualifications?->mbbs_marks_obtained) && !empty($qualifications?->mbbs_total_marks) && $qualifications->mbbs_total_marks > 0)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-400 light:bg-emerald-100 light:text-emerald-800">
                                    {{ round(($qualifications->mbbs_marks_obtained / $qualifications->mbbs_total_marks) * 100, 2) }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- 4. M.Phil (If Present) OR Summary Tile -->
                    @if(!empty($qualifications?->mphil_marks_obtained) || !empty($qualifications?->mphil_passing_year))
                        <div class="p-3 rounded-xl bg-slate-950/50 light:bg-slate-50 border border-slate-800/80 light:border-slate-200 space-y-2 hover:border-indigo-500/40 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-md bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 font-mono font-bold text-[10px] flex items-center justify-center">04</span>
                                    <span class="text-xs font-bold text-slate-100 light:text-slate-900">M.Phil / MS</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-md bg-slate-900 light:bg-white text-slate-300 light:text-slate-700 border border-slate-800 light:border-slate-200 text-[10px] font-mono font-bold">
                                    {{ $qualifications?->mphil_passing_year ?? 'N/A' }}
                                </span>
                            </div>

                            <div class="text-[11px] text-slate-300 light:text-slate-700 space-y-0.5">
                                <div class="font-semibold text-slate-200 light:text-slate-800 truncate" title="{{ $qualifications?->mphilExam?->name }}">
                                    {{ $qualifications?->mphilExam?->name ?? 'M.Phil' }} ({{ $qualifications?->mphil_science_subjects ?? 'Specialty' }})
                                </div>
                                <div class="text-[10px] text-slate-400 light:text-slate-500 truncate" title="{{ $qualifications?->mphilBoard?->name }}">
                                    {{ $qualifications?->mphilBoard?->name ?? 'University' }}
                                </div>
                            </div>

                            <div class="pt-1.5 border-t border-slate-800/40 light:border-slate-200 flex items-center justify-between text-[11px]">
                                <span class="font-mono font-bold text-slate-100 light:text-slate-900 text-xs">
                                    {{ $qualifications?->mphil_marks_obtained ?? 'N/A' }} / {{ $qualifications?->mphil_total_marks ?? 'N/A' }}
                                </span>
                                @if(!empty($qualifications?->mphil_marks_obtained) && !empty($qualifications?->mphil_total_marks) && $qualifications->mphil_total_marks > 0)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-400 light:bg-emerald-100 light:text-emerald-800">
                                        {{ round(($qualifications->mphil_marks_obtained / $qualifications->mphil_total_marks) * 100, 2) }}%
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Clinical Experience (If Present) -->
                @if(!empty($experiences) && count($experiences) > 0)
                    <div class="pt-2.5 border-t border-slate-800/40 light:border-slate-200 space-y-1.5">
                        <span class="text-[10px] font-bold text-slate-400 light:text-slate-500 uppercase tracking-wider block">Clinical Experience</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                            @foreach($experiences as $exp)
                                <div class="p-2 rounded-lg bg-slate-950/40 light:bg-slate-50 border border-slate-800/60 light:border-slate-200">
                                    <strong class="text-slate-200 light:text-slate-800 text-[11px] block">{{ $exp['designation'] ?? 'Designation' }}</strong>
                                    <span class="text-slate-400 text-[10px] block">{{ $exp['institute'] ?? 'Institute' }} ({{ $exp['fromDate'] ?? '' }} to {{ $exp['toDate'] ?? 'Present' }})</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- 3 & 4: Two Side-by-Side Sub-Columns for Preferences (Seat-Wise Tabs) & Documents -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                
                <!-- Specialty Preferences (Seat Category Wise Interactive Tabs) -->
                @php
                    $firstCatId = $seatCategories->first()?->id ?? 0;
                @endphp
                <div class="bg-slate-900/60 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl p-4 shadow-sm space-y-3"
                     x-data="{ activeSeatTab: {{ $firstCatId }} }">
                    
                    <div class="flex items-center justify-between pb-2 border-b border-slate-800/50 light:border-slate-200">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-400 light:bg-blue-600"></span>
                            <h4 class="text-xs font-bold text-slate-100 light:text-slate-900 uppercase tracking-wider">Specialty Preferences</h4>
                        </div>
                        <button type="button" wire:click="editStep(5)" class="px-2 py-0.5 rounded-lg bg-slate-800 hover:bg-slate-700 light:bg-slate-200 text-indigo-400 light:text-indigo-700 text-xs font-bold transition-colors">
                            Edit
                        </button>
                    </div>

                    @if($seatCategories->count() > 0)
                        <!-- Seat Category Interactive Tab Buttons -->
                        <div class="flex flex-wrap items-center gap-1.5 p-1 bg-slate-950/60 light:bg-slate-100 rounded-xl border border-slate-800/60 light:border-slate-200">
                            @foreach($seatCategories as $cat)
                                @php
                                    $catId = is_object($cat) ? $cat->id : $cat;
                                    $catName = is_object($cat) ? $cat->name : $cat;
                                    $count = $mphillPhdSubjects->where('seat_category_id', $catId)->count();
                                @endphp
                                <button type="button"
                                    @click="activeSeatTab = {{ $catId }}"
                                    class="px-2.5 py-1 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer"
                                    :class="activeSeatTab === {{ $catId }}
                                        ? 'bg-indigo-600 text-white shadow-sm'
                                        : 'text-slate-400 light:text-slate-600 hover:text-slate-200 light:hover:text-slate-900'">
                                    <span class="truncate max-w-[130px]">{{ $catName }}</span>
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold"
                                          :class="activeSeatTab === {{ $catId }} ? 'bg-indigo-700 text-white' : 'bg-slate-800 light:bg-slate-200 text-slate-300 light:text-slate-700'">
                                        {{ $count }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <!-- Category Wise Preference List Panels -->
                        <div class="space-y-1.5 max-h-56 overflow-y-auto custom-scrollbar pr-1">
                            @foreach($seatCategories as $cat)
                                @php
                                    $catId = is_object($cat) ? $cat->id : $cat;
                                    $programSubjects = $mphillPhdSubjects->where('seat_category_id', $catId);
                                @endphp
                                <div x-show="activeSeatTab === {{ $catId }}" x-transition.opacity.duration.200ms class="space-y-1.5">
                                    @forelse($programSubjects as $index => $sub)
                                        <div class="p-2.5 rounded-xl bg-slate-950/50 light:bg-slate-50 border border-slate-800/80 light:border-slate-200 flex items-start gap-2.5 hover:border-slate-700 light:hover:border-slate-300 transition-colors">
                                            <span class="w-6 h-6 rounded-md bg-indigo-500/10 light:bg-indigo-50 text-indigo-400 light:text-indigo-700 border border-indigo-500/20 light:border-indigo-200 font-mono font-bold text-[10px] flex items-center justify-center flex-shrink-0 mt-0.5">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-[11px] font-bold text-slate-100 light:text-slate-900 leading-snug break-words">
                                                    {{ $sub->subject }}
                                                </div>
                                                <span class="text-[9px] text-slate-400 light:text-slate-500 font-semibold uppercase tracking-wider block mt-0.5">
                                                    Preference #{{ $index + 1 }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 rounded-xl bg-slate-950/40 light:bg-slate-50 border border-slate-800/40 light:border-slate-200 text-center text-slate-500 text-xs italic">
                                            No preferences chosen for this category.
                                        </div>
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-3 text-slate-500 text-xs italic">No preferences recorded.</div>
                    @endif
                </div>

                <!-- Uploaded Documents Checklist (Compact Grid) -->
                <div class="bg-slate-900/60 light:bg-white border border-slate-800 light:border-slate-200 rounded-2xl p-4 shadow-sm space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-800/50 light:border-slate-200">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purple-400 light:bg-purple-600"></span>
                            <h4 class="text-xs font-bold text-slate-100 light:text-slate-900 uppercase tracking-wider">Uploaded Documents</h4>
                        </div>
                        <button type="button" wire:click="editStep(6)" class="px-2 py-0.5 rounded-lg bg-slate-800 hover:bg-slate-700 light:bg-slate-200 text-indigo-400 light:text-indigo-700 text-xs font-bold transition-colors">
                            Edit
                        </button>
                    </div>

                    <div class="space-y-1.5 max-h-64 overflow-y-auto custom-scrollbar pr-1">
                        @foreach($documents as $doc)
                            <div class="p-2 rounded-xl bg-slate-950/40 light:bg-slate-50 border border-slate-800/60 light:border-slate-200 flex items-center justify-between gap-2 text-xs">
                                <div class="min-w-0 flex-1">
                                    <div class="font-medium text-slate-200 light:text-slate-800 truncate text-[11px]" title="{{ $doc['label'] }}">{{ $doc['label'] }}</div>
                                    <div class="text-[10px] font-semibold {{ !empty($doc['url']) ? 'text-emerald-400 light:text-emerald-600' : 'text-slate-500' }}">
                                        {{ !empty($doc['url']) ? 'Uploaded' : ($doc['required'] ? 'Required' : 'Optional') }}
                                    </div>
                                </div>
                                @if(!empty($doc['url']))
                                    <button type="button" onclick="window.openDocModal('{{ $doc['url'] }}', '{{ addslashes($doc['label']) }}')" class="px-2 py-0.5 rounded-lg bg-indigo-600/15 hover:bg-indigo-600/25 light:bg-indigo-50 light:hover:bg-indigo-100 text-indigo-400 light:text-indigo-700 text-[11px] font-bold transition-colors flex-shrink-0">
                                        View
                                    </button>
                                @endif
                            </div>
                        @endforeach

                        @foreach($otherDocuments as $otherDoc)
                            <div class="p-2 rounded-xl bg-slate-950/40 light:bg-slate-50 border border-slate-800/60 light:border-slate-200 flex items-center justify-between gap-2 text-xs">
                                <div class="min-w-0 flex-1">
                                    <div class="font-medium text-slate-200 light:text-slate-800 truncate text-[11px]" title="{{ $otherDoc->name }}">{{ $otherDoc->name }}</div>
                                    <div class="text-[10px] font-semibold text-emerald-400 light:text-emerald-600">Uploaded</div>
                                </div>
                                <button type="button" onclick="window.openDocModal('{{ $otherDoc->getUrl() }}', '{{ addslashes($otherDoc->name) }}')" class="px-2 py-0.5 rounded-lg bg-indigo-600/15 hover:bg-indigo-600/25 light:bg-indigo-50 light:hover:bg-indigo-100 text-indigo-400 light:text-indigo-700 text-[11px] font-bold transition-colors flex-shrink-0">
                                    View
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Final Navigation Actions Footer -->
    <div class="flex items-center justify-between pt-4 border-t border-slate-800 light:border-slate-200">
        <button type="button" wire:click="back" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 light:bg-slate-100 light:hover:bg-slate-200 text-slate-300 light:text-slate-700 text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Documents</span>
        </button>

        <button type="button" wire:click="proceedToSubmit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs sm:text-sm font-semibold shadow-md shadow-indigo-600/30 transition-all flex items-center gap-1.5">
            <span>Proceed to Final Declaration</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>

</div>
