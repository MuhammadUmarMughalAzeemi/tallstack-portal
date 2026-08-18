<div class="bg-white/90 backdrop-blur-xl rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-200/50">
    <div class="space-y-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <x-icon name="clipboard-document-list" class="w-8 h-8 text-primary-600" />
            </div>
            <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase mt-4">Review Application</h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Please verify all information before final submission</p>
        </div>

        <div class="space-y-6">
            <!-- Data Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Identity</h4>
                    <p class="text-xs font-bold text-slate-900">{{ $allData[1]['full_name'] ?? 'Not provided' }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">{{ $allData[1]['email'] ?? '' }}</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Program</h4>
                    <p class="text-xs font-bold text-slate-900">{{ $allData[6]['program'] ?? 'Not selected' }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">{{ $allData[6]['campus'] ?? '' }} ({{ $allData[6]['study_mode'] ?? '' }})</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Education</h4>
                    <p class="text-xs font-bold text-slate-900">{{ $allData[3]['degree'] ?? 'Not provided' }}</p>
                    <p class="text-[10px] text-slate-500 mt-1">{{ $allData[3]['institution'] ?? '' }}</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Documents</h4>
                    <p class="text-[10px] font-bold text-green-600">{{ $allData[5]['id_metadata'] ?? 'Pending' }}</p>
                    <p class="text-[10px] font-bold text-green-600 mt-1">{{ $allData[5]['transcript_metadata'] ?? 'Pending' }}</p>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-between gap-4 border-t border-slate-50">
            <x-button wire:click="back" color="slate" flat class="h-12 px-6 rounded-xl font-black uppercase tracking-widest text-[9px]" left-icon="arrow-left">Back</x-button>
            <x-button wire:click="save" color="primary" class="h-12 px-10 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-primary-200 hover:translate-y-[-2px] transition-all" right-icon="check-circle">
                Proceed to Submit
            </x-button>
        </div>
    </div>
</div>
