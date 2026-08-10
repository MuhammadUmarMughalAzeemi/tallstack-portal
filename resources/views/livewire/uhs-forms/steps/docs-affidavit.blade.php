<form wire:submit="submit" class="space-y-6">
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 5: Document Uploads & Affidavit</h2>
        <p class="text-slate-400 text-sm">Upload clear scanned copies (JPG, PNG, PDF) of your original documents.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">CNIC / Passport Front Image</label>
            <input type="file" wire:model="cnic" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">CNIC / Passport Back Image</label>
            <input type="file" wire:model="cnicBackSide" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Father's CNIC Front Image</label>
            <input type="file" wire:model="fatherCnic" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Father's CNIC Back Image</label>
            <input type="file" wire:model="fatherCnicBackSide" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Passport Size Passport/Color Photo</label>
            <input type="file" wire:model="photo" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Digital Signature Image</label>
            <input type="file" wire:model="signature" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">Matric / SSC Transcript Certificate</label>
            <input type="file" wire:model="matricTranscript" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2">
            <label class="block text-xs font-semibold text-slate-300">F.Sc / HSSC Transcript Certificate</label>
            <input type="file" wire:model="intermediateTranscript" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 space-y-2 md:col-span-2">
            <label class="block text-xs font-semibold text-slate-300">Domicile Certificate</label>
            <input type="file" wire:model="domicileCertificate" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
        </div>
    </div>

    <!-- Final Terms & Declaration -->
    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-5 space-y-4">
        <h3 class="text-sm font-semibold text-indigo-400">Undertaking & Final Declaration</h3>
        <label class="flex items-start space-x-3 cursor-pointer">
            <input type="checkbox" wire:model="terms" value="1" class="mt-1 rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950">
            <span class="text-xs text-slate-300 leading-relaxed">
                I solemnly declare that all the information provided by me in this form is accurate and complete. If any document or statement is found forged or false at any stage, my application/admission shall be liable to immediate cancellation.
            </span>
        </label>
        @error('terms') <span class="text-xs text-rose-400 block">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end pt-6 border-t border-slate-800">
        <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold shadow-lg shadow-emerald-600/30 transition-all flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>Submit Application Final</span>
        </button>
    </div>
</form>
