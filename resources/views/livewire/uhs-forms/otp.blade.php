<div class="max-w-md mx-auto py-12 px-4">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl p-6 text-center space-y-6">
        <h2 class="text-xl font-bold text-slate-100">Verification OTP Required</h2>
        <p class="text-xs text-slate-400">Enter the 4-digit code sent to your registered mobile/email to edit your application form.</p>

        @if($message)
            <div class="p-3 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs rounded-xl">
                {{ $message }}
            </div>
        @endif

        <div class="space-y-4">
            <input type="text" wire:model="otp" maxlength="4" placeholder="Enter 4-digit OTP" class="w-full text-center tracking-widest text-2xl font-bold bg-slate-950 border border-slate-800 rounded-xl py-3 text-slate-100 focus:outline-none focus:border-indigo-500">
            <button wire:click="verifyOtp" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all text-sm">
                Verify OTP & Edit Application
            </button>
        </div>
    </div>
</div>
