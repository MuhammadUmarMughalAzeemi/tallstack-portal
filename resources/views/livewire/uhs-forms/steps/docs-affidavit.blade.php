<form wire:submit="submit" class="space-y-6">
    @include('livewire.partials.validation-errors')
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 6: Document Uploads & Affidavit</h2>
        <p class="text-slate-400 text-sm">Upload clear scanned copies (JPG, PNG, PDF) of your original documents.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">CNIC / Passport Front Image</label>
            <input type="file" wire:model="cnic"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="cnic" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">CNIC / Passport Back Image</label>
            <input type="file" wire:model="cnicBackSide"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="cnicBackSide" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Father's CNIC Front Image</label>
            <input type="file" wire:model="fatherCnic"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="fatherCnic" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Father's CNIC Back Image</label>
            <input type="file" wire:model="fatherCnicBackSide"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="fatherCnicBackSide" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Passport Size / Color Photo</label>
            <input type="file" wire:model="photo"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="photo" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Digital Signature Image</label>
            <input type="file" wire:model="signature"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="signature" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Matric / SSC Transcript Certificate</label>
            <input type="file" wire:model="matricTranscript"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="matricTranscript" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">F.Sc / HSSC Transcript Certificate</label>
            <input type="file" wire:model="intermediateTranscript"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="intermediateTranscript" class="text-xs text-indigo-400">Uploading...</div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2 md:col-span-2">
            <label class="block text-xs font-semibold text-slate-300">Domicile Certificate</label>
            <input type="file" wire:model="domicileCertificate"
                class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
            <div wire:loading wire:target="domicileCertificate" class="text-xs text-indigo-400">Uploading...</div>
        </div>
    </div>

    <!-- Final Terms & Declaration -->
    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-sm font-semibold text-indigo-400">Undertaking & Final Declaration</h3>
        <label class="flex items-start space-x-3 cursor-pointer">
            <input type="checkbox" wire:model="terms" value="1"
                class="mt-1 rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950
                {{ $errors->has('terms') ? 'border-rose-500' : '' }}">
            <span class="text-xs text-slate-300 leading-relaxed">
                I solemnly declare that all the information provided by me in this form is accurate and complete. If any document or statement is found forged or false at any stage, my application/admission shall be liable to immediate cancellation.
            </span>
        </label>
        @error('terms') <span class="text-xs text-rose-400 block mt-1">You must accept the declaration to proceed.</span> @enderror
    </div>

    <div class="pt-6 flex justify-between gap-4 border-t border-slate-800">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold shadow-lg shadow-emerald-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <svg wire:loading.remove wire:target="submit" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span wire:loading.remove wire:target="submit">Submit Application Final</span>
            <span wire:loading wire:target="submit">Submitting...</span>
        </button>
    </div>
</form>
