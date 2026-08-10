<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50 border border-white">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <x-icon name="briefcase" class="w-8 h-8 text-primary-600" />
            </div>
            <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase mt-4">Professional History</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Brief summary of your work experience</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <x-input 
                    wire:model="job_title" 
                    label="CURRENT / LAST JOB TITLE" 
                    placeholder="Senior Developer" 
                    class="rounded-xl border-slate-200 bg-white/50 focus:bg-white transition-all sm:py-2"
                    required />
            </div>
            
            <x-input 
                wire:model="company" 
                label="ORGANIZATION NAME" 
                placeholder="Tech Solutions Inc." 
                class="rounded-xl border-slate-200 bg-white/50 focus:bg-white transition-all sm:py-2"
                required />

            <x-input 
                wire:model="years_experience" 
                label="YEARS OF EXPERIENCE" 
                placeholder="2" 
                class="rounded-xl border-slate-200 bg-white/50 focus:bg-white transition-all sm:py-2"
                required />
        </div>

        <div class="pt-6 flex justify-between gap-4 border-t border-slate-50">
            <x-button wire:click="back" color="slate" flat class="h-12 px-6 rounded-xl font-black uppercase tracking-widest text-[9px]" left-icon="arrow-left">Back</x-button>
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" color="primary" class="h-12 px-10 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-primary-200 hover:translate-y-[-2px] transition-all" right-icon="arrow-right">
                <span wire:loading.remove.delay wire:target="save">Continue to Documents</span>
                <span wire:loading.delay wire:target="save">Saving...</span>
            </x-button>
        </div>
    </div>
</div>
