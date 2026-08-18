<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-primary-600 rounded-[28px] flex items-center justify-center mx-auto shadow-2xl shadow-primary-200 rotate-3 transition-transform hover:rotate-0">
                <x-icon name="check-circle" class="w-10 h-10 text-white" />
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter uppercase mt-6">Secure Submission</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Finalize your enrollment application</p>
        </div>

        <div class="p-6 rounded-3xl bg-primary-50/50 border border-primary-100 space-y-4">
            <div class="ml-1">
                <x-checkbox 
                    wire:model="declaration" 
                    label="I declare that all information provided is true and accurate to the best of my knowledge." 
                    class="rounded-md" />
                @error('declaration')
                    <p class="mt-2 text-sm text-red-600 font-medium ml-7">{{ $message }}</p>
                @enderror
            </div>
            
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
                class="h-14 px-12 rounded-2xl font-black uppercase tracking-[0.3em] text-[11px] shadow-2xl shadow-primary-300 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center" 
                right-icon="paper-airplane">

                <span wire:loading.inline wire:target="submit" class="mr-2">
                    <svg class="w-4 h-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </span>

                <span wire:loading.remove.delay wire:target="submit">Submit Application</span>
                <span wire:loading.delay wire:target="submit">Transmitting...</span>
            </x-button>
        </div>
    </div>
</div>
