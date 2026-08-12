<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50 border border-white">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <x-icon name="cloud-arrow-up" class="w-8 h-8 text-primary-600" />
            </div>
            <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase mt-4">Document Verification</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Maximum file size: 2MB (ID) / 5MB (Transcript)</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">Identity Proof (Image)</p>
                <x-upload
                    id="id_proof_upload"
                    wire:key="id_proof_upload"
                    wire:model="id_proof"
                    placeholder="Select ID Card"
                    class="rounded-2xl border-dashed border-2 border-slate-200 hover:border-primary-300 transition-colors"
                    required />
                @error('id_proof') <p class="text-[10px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                @if($id_metadata !== 'Pending')
                    <div class="flex items-center gap-2 text-[10px] text-green-600 font-bold uppercase tracking-widest mt-2 ml-1">
                        <x-icon name="check-circle" class="w-4 h-4" />
                        {{ $id_metadata }}
                    </div>
                @endif
            </div>

            <div class="space-y-2">
                <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">Academic Transcript (PDF/Image)</p>
                <x-upload
                    id="transcript_upload"
                    wire:key="transcript_upload"
                    wire:model="transcript"
                    placeholder="Select Transcript"
                    class="rounded-2xl border-dashed border-2 border-slate-200 hover:border-primary-300 transition-colors"
                    required />
                @error('transcript') <p class="text-[10px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                @if($transcript_metadata !== 'Pending')
                    <div class="flex items-center gap-2 text-[10px] text-green-600 font-bold uppercase tracking-widest mt-2 ml-1">
                        <x-icon name="check-circle" class="w-4 h-4" />
                        {{ $transcript_metadata }}
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-6 flex justify-between gap-4 border-t border-slate-50">
            <x-button wire:click="back" color="slate" flat class="h-12 px-6 rounded-xl font-black uppercase tracking-widest text-[9px]" left-icon="arrow-left">Back</x-button>
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save, id_proof, transcript" color="primary" class="h-12 px-10 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-primary-200 hover:translate-y-[-2px] transition-all flex items-center justify-center" right-icon="arrow-right">
                <span wire:loading.inline wire:target="save, id_proof, transcript" class="mr-2">
                    <svg class="w-4 h-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </span>

                <span wire:loading.remove.delay wire:target="save, id_proof, transcript">Upload & Continue</span>
                <span wire:loading.delay wire:target="save, id_proof, transcript">Processing...</span>
            </x-button>
        </div>
    </div>
</div>
