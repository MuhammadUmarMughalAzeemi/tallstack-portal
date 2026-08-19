<div class="min-h-screen flex flex-col md:flex-row font-sans selection:bg-indigo-500 selection:text-white relative overflow-hidden transition-colors duration-500">

    <!-- Atmospheric Ambient Lighting Accents -->
    <div class="absolute top-[-10%] left-[-10%] w-[45%] h-[45%] rounded-full blur-[140px] pointer-events-none transition-all duration-500 bg-indigo-600/10 light:bg-indigo-500/5"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[45%] h-[45%] rounded-full blur-[140px] pointer-events-none transition-all duration-500 bg-purple-600/10 light:bg-purple-500/5"></div>

    <!-- Mobile Header Navigation -->
    <div class="md:hidden bg-slate-900/90 backdrop-blur-xl border-b border-slate-800/80 p-4 sticky top-0 z-50 light:bg-white/95 light:border-slate-200">
        @php $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7]; $mobileDisplayNum = $stepDisplayMap[$currentStep] ?? $currentStep; @endphp
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white text-xs shadow-md">UHS</div>
                <h1 class="text-xs font-black tracking-wider uppercase text-slate-100 light:text-slate-900">Post Graduate Portal</h1>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-[11px] font-black text-indigo-400 light:text-indigo-700 font-inter">{{ round(($mobileDisplayNum / 7) * 100) }}%</div>
            </div>
        </div>
        <div class="w-full bg-slate-800 light:bg-slate-200 h-1.5 rounded-full overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-full transition-all duration-700" style="width: {{ ($mobileDisplayNum / 7) * 100 }}%"></div>
        </div>
    </div>

    <!-- Glassmorphic 3D Floating Fixed Sidebar -->
    <aside class="hidden md:flex fixed top-0 left-0 bottom-0 w-80 h-screen z-40 flex-col backdrop-blur-2xl border-r border-slate-800/80 font-inter transition-colors duration-500 bg-slate-950/90 light:bg-slate-50/95 light:border-slate-200">
        {{-- Sidebar Header --}}
        <div class="p-6 border-b border-slate-800/80 light:border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/30 border border-white/20 ring-2 ring-indigo-500/20 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-base font-black tracking-tight uppercase text-slate-100 light:text-slate-900 leading-tight">UHS Lahore</h1>
                        <p class="text-[9px] font-black uppercase tracking-[0.22em] text-indigo-400 light:text-indigo-700">Post Graduate Portal</p>
                    </div>
                </div>
            </div>

            {{-- 3D Progress Pill Card --}}
            <div class="p-3.5 rounded-2xl bg-slate-900/60 border border-slate-800/80 shadow-inner light:bg-white light:border-slate-200/90 light:shadow-xs space-y-2.5">
                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider">
                    <span class="text-slate-400 light:text-slate-500">Progress</span>
                    @php $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7]; $sidebarDisplayNum = $stepDisplayMap[$currentStep] ?? $currentStep; @endphp
                    <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-indigo-500/15 text-indigo-300 border border-indigo-500/30 light:bg-indigo-50 light:text-indigo-700 light:border-indigo-200">
                        {{ round(($sidebarDisplayNum / 7) * 100) }}%
                    </span>
                </div>
                <div class="h-2 w-full bg-slate-800/90 light:bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-700/50 light:border-slate-200">
                    <div class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 rounded-full transition-all duration-700 shadow-sm shadow-indigo-500/30" style="width: {{ ($sidebarDisplayNum / 7) * 100 }}%"></div>
                </div>
            </div>
        </div>

        {{-- 3D Step Cards Nav --}}
        <nav class="flex-1 px-4 py-4 overflow-y-auto custom-scrollbar space-y-2.5">
            @php 
                $displayNum = 0; 
                $stepKeys = array_keys($steps);
            @endphp
            @foreach($steps as $stepNumber => $step)
                @php
                    $displayNum++;
                    $isActive = $currentStep == $stepNumber;
                    $isCompleted = $step['completed'];
                    $currentIndex = array_search($stepNumber, $stepKeys);
                    $prevStepKey = $currentIndex > 0 ? $stepKeys[$currentIndex - 1] : null;
                    $isUnlocked = $stepNumber <= $currentStep || ($stepNumber === 1) || ($prevStepKey && ($steps[$prevStepKey]['completed'] ?? false));
                    $showStep = true;
                @endphp

                @if($showStep)
                <button
                    @if(! $isUnlocked) disabled @endif
                    wire:click="goToStep({{ $stepNumber }})"
                    class="w-full text-left group relative flex items-center gap-3.5 p-3.5 rounded-2xl transition-all duration-300
                    @if($isActive)
                        bg-gradient-to-r from-indigo-900/70 via-indigo-950/90 to-purple-950/60 border border-indigo-500/60 shadow-lg shadow-indigo-600/20 translate-x-1
                        light:bg-gradient-to-r light:from-indigo-50/95 light:via-white light:to-purple-50/70 light:border-indigo-300 light:shadow-md light:shadow-indigo-500/15
                    @elseif($isCompleted)
                        bg-slate-900/70 border border-slate-800/90 hover:border-emerald-500/40 hover:bg-slate-800/80 hover:-translate-y-0.5 shadow-sm
                        light:bg-white light:border-slate-200/90 light:shadow-xs light:hover:border-emerald-400/80 light:hover:bg-slate-50/90 light:hover:shadow-sm
                    @else
                        bg-slate-950/40 border border-slate-800/50 hover:border-slate-700/80 hover:bg-slate-900/60 shadow-xs
                        light:bg-white/90 light:border-slate-200/80 light:shadow-xs light:hover:bg-white light:hover:border-slate-300
                    @endif"
                >
                    {{-- 3D Left Glow Accent Bar for Active Card --}}
                    @if($isActive)
                        <div class="absolute left-0 top-3 bottom-3 w-1.5 rounded-r-full bg-gradient-to-b from-indigo-400 to-purple-500 shadow-md shadow-indigo-400/50 light:from-indigo-600 light:to-purple-600"></div>
                    @endif

                    {{-- 3D Step Avatar Badge --}}
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-xs font-black transition-all duration-300 flex-shrink-0
                        @if($isActive)
                            bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-600/40 ring-2 ring-indigo-400/40 border border-white/20
                        @elseif($isCompleted)
                            bg-emerald-500/15 text-emerald-400 border border-emerald-500/35 shadow-xs light:bg-emerald-50 light:text-emerald-700 light:border-emerald-200
                        @else
                            bg-slate-800/90 text-slate-400 border border-slate-700/70 shadow-xs light:bg-slate-100 light:text-slate-600 light:border-slate-200
                        @endif
                    ">
                        @if($isCompleted && !$isActive)
                            <svg class="w-4 h-4 text-emerald-400 light:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            {{ $displayNum }}
                        @endif
                    </div>

                    {{-- Step Information --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-1 mb-0.5">
                            <span class="text-[9px] font-black uppercase tracking-widest
                                @if($isActive)
                                    text-indigo-400 light:text-indigo-700
                                @else
                                    text-slate-500 light:text-slate-500
                                @endif
                            ">
                                STEP {{ str_pad($displayNum, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            @if($isActive)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[8.5px] font-black tracking-wider uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/40 light:bg-indigo-600 light:text-white light:border-transparent shadow-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 light:bg-white animate-pulse"></span>
                                    Active
                                </span>
                            @elseif($isCompleted)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[8.5px] font-black tracking-wider uppercase bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 light:bg-emerald-50 light:text-emerald-700 light:border-emerald-200 hover:bg-emerald-600 hover:text-white transition-all shadow-xs">
                                    Edit
                                </span>
                            @endif
                        </div>

                        <p class="text-xs uppercase tracking-tight truncate
                            @if($isActive)
                                font-black text-white light:text-indigo-950
                            @elseif($isCompleted)
                                font-bold text-slate-100 light:text-slate-900
                            @else
                                font-bold text-slate-300 light:text-slate-700
                            @endif
                        ">
                            {{ $step['name'] }}
                        </p>
                    </div>
                </button>
                @endif
            @endforeach
        </nav>

        {{-- Sidebar Footer --}}
        <div class="p-4 border-t border-slate-800/80 light:border-slate-200/90 space-y-2">
            <a href="{{ route('uhs-form-dashboard') }}" class="w-full flex items-center justify-center gap-2 p-2.5 rounded-2xl bg-slate-900/80 hover:bg-slate-800 text-slate-200 hover:text-white border border-slate-800/90 hover:border-slate-700 transition-all text-xs font-bold shadow-sm light:bg-white light:hover:bg-slate-100 light:text-slate-800 light:border-slate-200 light:shadow-xs">
                <svg class="w-4 h-4 text-slate-400 light:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Candidate Dashboard</span>
            </a>
            <button wire:click="logout" class="w-full flex items-center justify-center gap-2 p-2.5 rounded-2xl hover:bg-rose-500/10 text-slate-400 hover:text-rose-400 transition-all text-xs font-bold light:text-slate-600 light:hover:text-rose-600 light:hover:bg-rose-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Logout Session</span>
            </button>
        </div>
    </aside>

    <!-- Content Workspace -->
    <main class="flex-1 md:ml-80 min-h-screen z-10 font-inter">
        <!-- Fixed Glassmorphic Top Navigation Header -->
        <header class="hidden md:flex fixed top-0 left-80 right-0 h-20 z-30 backdrop-blur-xl border-b border-slate-800/80 px-8 items-center justify-between transition-all bg-slate-900/80 light:bg-white/90 light:border-slate-200">
            <div class="flex items-center gap-4">
                @if($currentStep > 1)
                    @php
                        // Step 4 bypassed — back from step 5 goes to step 3
                        $prevStep = $currentStep - 1;
                        if ($prevStep === 4) $prevStep = 3;
                    @endphp
                @endif

                <div>
                    <span class="text-[10px] font-black text-indigo-400 light:text-indigo-700 uppercase tracking-widest">Active Module</span>
                    @php
                        // Map internal step number to display number (step 4 skipped)
                        $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7];
                        $displayStepNum = $stepDisplayMap[$currentStep] ?? $currentStep;
                    @endphp
                    <h2 class="text-xl font-bold uppercase tracking-tight text-slate-100 light:text-slate-900">Step {{ $displayStepNum }}: {{ $steps[$currentStep]['name'] ?? 'Loading...' }}</h2>
                </div>
            </div>

            <div class="flex items-center space-x-2.5">
                <x-user-theme-toggle />
                <a href="{{ route('uhs-form-dashboard') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl border border-slate-700 hover:border-slate-600 text-xs font-bold transition-all light:bg-white light:hover:bg-slate-100 light:text-slate-700 light:border-slate-300 light:shadow-sm flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400 light:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('uhs-form-application-status') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl shadow-md shadow-indigo-600/30 text-xs font-bold transition-all flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Full Summary
                </a>
            </div>
        </header>

        <!-- Dynamic Step Components Workspace -->
        <div class="pt-24 pb-12 px-4 md:px-8">
            <div :class="$store.portalTheme.theme === 'light' ? 'bg-white/95 border-slate-200 shadow-xl' : 'bg-slate-900/80 border-slate-800 shadow-2xl'"
                 class="max-w-8xl mx-auto backdrop-blur-2xl border rounded-3xl p-6 md:p-8 transition-colors duration-500">
            @if($currentStep == 1)
                @livewire('uhs-forms.steps.programs', key('step-1'))
            @elseif($currentStep == 2)
                @livewire('uhs-forms.steps.personal-details', key('step-2'))
            @elseif($currentStep == 3)
                @livewire('uhs-forms.steps.qualifications', key('step-3'))
            {{-- Step 4 (Admission Test) bypassed — preserved for future use
            @elseif($currentStep == 4)
                @livewire('uhs-forms.steps.admission-test', key('step-4'))
            --}}
            @elseif($currentStep == 5)
                @livewire('uhs-forms.steps.colleges-list', key('step-5'))
            @elseif($currentStep == 6)
                @livewire('uhs-forms.steps.docs-affidavit', key('step-6'))
            @elseif($currentStep == 7)
                @livewire('uhs-forms.steps.step-one', key('step-7'))
            @elseif($currentStep == 8)
                @livewire('uhs-forms.steps.submit', key('step-8'))
            @endif
        </div>
        </div>
    </main>
</div>
