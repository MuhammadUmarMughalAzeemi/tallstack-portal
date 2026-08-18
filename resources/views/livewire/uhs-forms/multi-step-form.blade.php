<div class="min-h-screen flex flex-col md:flex-row font-sans selection:bg-indigo-500 selection:text-white relative overflow-hidden transition-colors duration-500">

    <!-- Atmospheric Ambient Lighting Accents -->
    <div class="absolute top-[-10%] left-[-10%] w-[45%] h-[45%] rounded-full blur-[140px] pointer-events-none transition-all duration-500 bg-indigo-600/10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[45%] h-[45%] rounded-full blur-[140px] pointer-events-none transition-all duration-500 bg-purple-600/10"></div>

    <!-- Mobile Header Navigation -->
    <div class="md:hidden bg-slate-900/90 backdrop-blur-xl border-b border-slate-800/80 p-4 sticky top-0 z-50">
        @php $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7]; $mobileDisplayNum = $stepDisplayMap[$currentStep] ?? $currentStep; @endphp
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center font-bold text-white text-xs">UHS</div>
                <h1 class="text-xs font-black tracking-wider uppercase">Post Graduate Portal</h1>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-[11px] font-bold text-indigo-400 font-inter">{{ round(($mobileDisplayNum / 7) * 100) }}%</div>
            </div>
        </div>
        <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-full transition-all duration-700" style="width: {{ ($mobileDisplayNum / 7) * 100 }}%"></div>
        </div>
    </div>

    <!-- Glassmorphic Fixed Sidebar -->
    <aside class="hidden md:flex fixed top-0 left-0 bottom-0 w-80 h-screen z-40 flex-col backdrop-blur-2xl border-r font-inter transition-colors duration-500">
        <div class="p-6 border-b border-slate-800/80">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-base font-black tracking-tight uppercase">UHS Lahore</h1>
                        <p class="text-[9px] font-bold text-indigo-400 uppercase tracking-[0.2em]">Post Graduate Portal</p>
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    <span>Progress</span>
                    @php $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7]; $sidebarDisplayNum = $stepDisplayMap[$currentStep] ?? $currentStep; @endphp
                    <span class="text-indigo-400">{{ round(($sidebarDisplayNum / 7) * 100) }}%</span>
                </div>
                <div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 transition-all duration-700" style="width: {{ ($sidebarDisplayNum / 7) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 overflow-y-auto custom-scrollbar space-y-1">
            @php $displayNum = 0; @endphp
            @foreach($steps as $stepNumber => $step)
                @php
                    $displayNum++;
                    $isActive = $currentStep == $stepNumber;
                    $isCompleted = $step['completed'];
                    $isUnlocked = $stepNumber <= $currentStep || ($stepNumber === 1) || ($steps[$stepNumber - 1]['completed'] ?? false);
                    // Show all steps: completed, active, unlocked, and next unlocked step
                    $showStep = true;
                @endphp

                @if($showStep)
                <button
                    @if(! $isUnlocked) disabled @endif
                    wire:click="goToStep({{ $stepNumber }})"
                    class="w-full text-left group relative flex items-center gap-3 p-3 rounded-xl transition-all duration-300
                    {{ $isActive ? 'bg-indigo-600/20 border border-indigo-500/40 shadow-lg shadow-indigo-600/10 translate-x-1' : 'hover:bg-slate-800/40 border border-transparent' }}"
                >
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold transition-all duration-300
                        {{ $isActive ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/40' : ($isCompleted ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400') }}
                    ">
                        @if($isCompleted && !$isActive)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            {{ $displayNum }}
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] font-bold uppercase tracking-widest {{ $isActive ? 'text-indigo-400' : 'text-slate-500' }}">
                                STEP {{ str_pad($displayNum, 2, '0', STR_PAD_LEFT) }}
                            </p>
                            @if($isCompleted && !$isActive)
                                <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest hover:underline">Edit</span>
                            @endif
                        </div>
                        <p class="text-xs font-bold uppercase tracking-tight truncate {{ $isActive ? 'text-slate-100' : 'text-slate-300' }}">
                            {{ $step['name'] }}
                        </p>
                    </div>
                </button>
                @endif
            @endforeach
        </nav>

        <div class="p-4 border-t border-slate-800/80 space-y-2">
            <a href="{{ route('uhs-form-dashboard') }}" class="w-full flex items-center justify-center gap-2 p-2.5 rounded-xl bg-slate-800/60 hover:bg-slate-800 text-slate-300 hover:text-white transition-all text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Candidate Dashboard</span>
            </a>
            <button wire:click="logout" class="w-full flex items-center justify-center gap-2 p-2.5 rounded-xl hover:bg-rose-500/10 text-slate-400 hover:text-rose-400 transition-all text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Logout Session</span>
            </button>
        </div>
    </aside>

    <!-- Content Workspace -->
    <main class="flex-1 md:ml-80 min-h-screen z-10 font-inter">
        <!-- Fixed Glassmorphic Top Navigation Header -->
        <header class="hidden md:flex fixed top-0 left-80 right-0 h-20 z-30 backdrop-blur-xl border-b border-slate-800/80 px-8 items-center justify-between transition-all">
            <div class="flex items-center gap-4">
                @if($currentStep > 1)
                    @php
                        // Step 4 bypassed — back from step 5 goes to step 3
                        $prevStep = $currentStep - 1;
                        if ($prevStep === 4) $prevStep = 3;
                    @endphp
                @endif

                <div>
                    <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Active Module</span>
                    @php
                        // Map internal step number to display number (step 4 skipped)
                        $stepDisplayMap = [1=>1, 2=>2, 3=>3, 5=>4, 6=>5, 7=>6, 8=>7];
                        $displayStepNum = $stepDisplayMap[$currentStep] ?? $currentStep;
                    @endphp
                    <h2 class="text-xl font-bold uppercase tracking-tight">Step {{ $displayStepNum }}: {{ $steps[$currentStep]['name'] ?? 'Loading...' }}</h2>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <x-user-theme-toggle />
                <a href="{{ route('uhs-form-dashboard') }}" class="px-4 py-2 bg-slate-800/80 hover:bg-slate-800 text-slate-200 rounded-xl border border-slate-700 text-xs font-semibold transition-all">
                    Dashboard
                </a>
                <a href="{{ route('uhs-form-application-status') }}" class="px-4 py-2 bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-300 rounded-xl border border-indigo-500/40 text-xs font-semibold transition-all">
                    Full Summary
                </a>
            </div>
        </header>

        <!-- Dynamic Step Components Workspace -->
        <div class="pt-24 pb-12 px-4 md:px-8">
            <div :class="$store.portalTheme.theme === 'light' ? 'bg-white/90 border-slate-200 shadow-xl' : 'bg-slate-900/80 border-slate-800 shadow-2xl'"
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
