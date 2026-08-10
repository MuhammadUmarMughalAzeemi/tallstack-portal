<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50 border border-white">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-primary-600 rounded-[28px] flex items-center justify-center mx-auto shadow-2xl shadow-primary-200 rotate-3 transition-transform hover:rotate-0">
                <x-icon name="check-circle" class="w-10 h-10 text-white" />
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter uppercase mt-6">Secure Submission</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Finalize your enrollment application</p>
        </div>

        <div class="p-6 rounded-3xl bg-primary-50/50 border border-primary-100 space-y-4">
            <x-checkbox 
                wire:model="declaration" 
                label="I declare that all information provided is true and accurate to the best of my knowledge." 
                class="rounded-md" />
            
            <p class="text-[10px] text-primary-600/70 font-medium leading-relaxed ml-7">
                By clicking submit, you agree to our terms of service and privacy policy regarding your academic records.
            </p>
        </div>

        <div class="pt-6 flex justify-between gap-4 border-t border-slate-50">
            <x-button wire:click="back" color="slate" flat class="h-12 px-6 rounded-xl font-black uppercase tracking-widest text-[9px]" left-icon="arrow-left">Back</x-button>
            <x-button 
                wire:click="submit" 
                wire:loading.attr="disabled"
                wire:target="submit"
                color="primary" 
                class="h-14 px-12 rounded-2xl font-black uppercase tracking-[0.3em] text-[11px] shadow-2xl shadow-primary-300 hover:scale-[1.02] active:scale-95 transition-all" 
                right-icon="paper-airplane">
                <span wire:loading.remove.delay wire:target="submit">Submit Application</span>
                <span wire:loading.delay wire:target="submit">Transmitting...</span>
            </x-button>
        </div>
    </div>
</div>
