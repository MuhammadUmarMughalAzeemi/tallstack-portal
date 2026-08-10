<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="bg-slate-900/90 backdrop-blur-2xl border border-slate-800/90 rounded-3xl shadow-2xl overflow-hidden mb-8 p-6 md:p-8 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-800 pb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-100 uppercase tracking-tight">Post Graduate Admission Portal</h1>
                <p class="text-slate-400 text-sm">University of Health Sciences Lahore</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <div class="px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-xs font-semibold">
                    Step {{ $step }} of 7
                </div>
                <a href="{{ route('uhs-form-dashboard') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl transition-all">
                    Dashboard &rarr;
                </a>
            </div>
        </div>

        <!-- Horizontal Step Stepper Navigation -->
        <div class="grid grid-cols-2 md:grid-cols-7 gap-2">
            <button wire:click="goToStep(1)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 1 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step1Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                1. Category
            </button>
            <button wire:click="goToStep(2)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 2 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step2Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                2. Personal
            </button>
            <button wire:click="goToStep(3)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 3 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step3Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                3. Qualification
            </button>
            <button wire:click="goToStep(4)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 4 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step4Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                4. Entry Test
            </button>
            <button wire:click="goToStep(5)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 5 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step5Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                5. Preferences
            </button>
            <button wire:click="goToStep(6)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 6 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step6Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                6. Documents
            </button>
            <button wire:click="goToStep(7)" class="p-3 text-center rounded-xl text-xs font-bold transition-all {{ $step == 7 ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : ($step7Completed ? 'bg-emerald-950/40 text-emerald-400 border border-emerald-800/50' : 'bg-slate-800/50 text-slate-400 hover:bg-slate-800') }}">
                7. Review
            </button>
        </div>

        <!-- Step Content Container -->
        <div class="bg-slate-950/60 border border-slate-800/80 rounded-2xl p-6 md:p-8 shadow-inner">
            @if ($step == 1)
                @livewire('uhs-forms.steps.programs')
            @elseif ($step == 2)
                @livewire('uhs-forms.steps.personal-details')
            @elseif ($step == 3)
                @livewire('uhs-forms.steps.qualifications')
            @elseif ($step == 4)
                @livewire('uhs-forms.steps.admission-test')
            @elseif ($step == 5)
                @livewire('uhs-forms.steps.colleges-list')
            @elseif ($step == 6)
                @livewire('uhs-forms.steps.docs-affidavit')
            @elseif ($step == 7)
                @livewire('uhs-forms.steps.step-one')
            @endif
        </div>
    </div>
</div>
