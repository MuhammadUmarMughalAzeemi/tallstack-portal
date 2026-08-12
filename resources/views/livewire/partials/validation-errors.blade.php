@if ($errors->any())
<div class="bg-rose-500/10 border border-rose-500/40 rounded-xl p-4 mb-2">
    <div class="flex items-start gap-3">
        <div class="flex-shrink-0 mt-0.5">
            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-bold text-rose-400">{{ __('Please fix the following errors before continuing:') }}</p>
            <ul class="mt-2 space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-xs text-rose-300">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
