<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50 border border-white">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <x-icon name="building-library" class="w-8 h-8 text-primary-600" />
            </div>
            <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase mt-4">Enrollment Choices</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Select your desired program and location</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <x-select.styled
                wire:model="program"
                label="ACADEMIC PROGRAM"
                placeholder="Choose a program"
                :options="['Computer Science', 'Business Administration', 'Data Analytics', 'Digital Marketing']"
                class="rounded-xl"
                required />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-select.styled
                    wire:model="study_mode"
                    label="STUDY MODE"
                    placeholder="Select mode"
                    :options="['Full-time', 'Part-time', 'Online', 'Hybrid']"
                    class="rounded-xl"
                    required />

                <x-select.styled
                    wire:model="campus"
                    label="CAMPUS LOCATION"
                    placeholder="Select campus"
                    :options="['Main Campus', 'Downtown Center', 'Virtual Campus']"
                    class="rounded-xl"
                    required />
            </div>
        </div>

        <div class="pt-6 flex justify-between gap-4 border-t border-slate-50">
            <x-button wire:click="back" color="slate" flat class="h-12 px-6 rounded-xl font-black uppercase tracking-widest text-[9px]" left-icon="arrow-left">Back</x-button>
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" color="primary" class="h-12 px-10 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-primary-200 hover:translate-y-[-2px] transition-all flex items-center justify-center" right-icon="arrow-right">
                <span wire:loading.inline wire:target="save" class="mr-2">
                    <svg class="w-4 h-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </span>

                <span wire:loading.remove.delay wire:target="save">Continue to Review</span>
                <span wire:loading.delay wire:target="save">Saving...</span>
            </x-button>
        </div>
    </div>
</div>
