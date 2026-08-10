<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden p-6 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-800 pb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-100 uppercase tracking-tight">Post Graduate Applicant Dashboard</h1>
                <p class="text-slate-400 text-sm">University of Health Sciences Lahore</p>
            </div>
            <div class="mt-4 md:mt-0 flex flex-wrap items-center gap-3">
                <a href="{{ route('uhs-form') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit / Update Application</span>
                </a>
                <a href="{{ route('uhs-form-application-status') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-xl transition-all">
                    View Full Summary
                </a>
                <a href="{{ route('download.challan') }}" target="_blank" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold rounded-xl shadow-lg shadow-emerald-600/20 transition-all flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Download BOP Fee Challan</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Application Review Status</div>
                <div class="flex items-center space-x-2">
                    @if(auth()->user()->status == 1)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">APPROVED &check;</span>
                    @elseif(auth()->user()->status == 2)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30">PENDING REVIEW</span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-500/10 text-rose-400 border border-rose-500/30">REJECTED</span>
                    @endif
                </div>
            </div>

            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Fee Payment Status</div>
                <div class="text-lg font-bold {{ auth()->user()->is_paid ? 'text-emerald-400' : 'text-amber-400' }}">
                    {{ auth()->user()->is_paid ? 'PAID & VERIFIED' : 'UNPAID / PENDING' }}
                </div>
            </div>

            <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Challan ID</div>
                <div class="text-lg font-mono font-bold text-slate-100">
                    #{{ auth()->user()->challan_id ?? 'Not Generated' }}
                </div>
            </div>
        </div>

        <!-- Upload Paid Fee Challan -->
        <div class="bg-slate-950/60 border border-slate-800 rounded-2xl p-6 space-y-4">
            <h3 class="text-base font-bold text-slate-100">Upload Paid Fee Challan Copy</h3>
            <p class="text-xs text-slate-400">After depositing the fee in Bank of Punjab, upload the stamped candidate copy here for verification.</p>

            <form wire:submit="submitChallan" class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                <input type="file" wire:model="challan" class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl shadow-lg shadow-indigo-600/30 transition-all">
                    Upload Copy
                </button>
            </form>

            @if($challanSubmitted)
                <div class="p-3 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-emerald-400 text-xs font-medium">
                    Fee challan uploaded successfully! Our verification team will review it.
                </div>
            @endif
        </div>

        <!-- Applicant Details Overview with Quick Edit Button -->
        <div class="bg-slate-950/40 border border-slate-800 rounded-2xl p-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3 mb-4">
                <h3 class="text-base font-bold text-slate-100">Applicant Profile Overview</h3>
                <a href="{{ route('uhs-form') }}" class="px-3 py-1 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/40 text-indigo-300 rounded-lg text-xs font-bold transition-all flex items-center space-x-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Profile & Form</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-300">
                <div><span class="text-slate-500 block">Candidate Name</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->name }}</strong></div>
                <div><span class="text-slate-500 block">Father's Name</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->father_name }}</strong></div>
                <div><span class="text-slate-500 block">Email Address</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->email }}</strong></div>
                <div><span class="text-slate-500 block">Mobile Number</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->mobile_number }}</strong></div>
                <div><span class="text-slate-500 block">CNIC / Passport</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->cnic_passport }}</strong></div>
                <div><span class="text-slate-500 block">Submitted At</span> <strong class="text-slate-100 text-sm">{{ auth()->user()->submitted_at?->format('d M Y, h:i A') }}</strong></div>
            </div>
        </div>
    </div>
</div>
