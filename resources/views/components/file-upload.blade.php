@props([
    'id',
    'file'     => null,
    'saved'    => null,   // URL string of already-saved file from DB
    'required' => false,
    'label'    => 'Upload Image',
    'accept'   => 'image/*',
])

<div class="w-full font-sans">
    @if($saved && ! $file)
        {{-- ── State 1: Saved in Database ── --}}
        <div class="flex items-center justify-between p-2.5 bg-white border border-teal-200/90 rounded-xl shadow-sm hover:border-teal-400 transition-all">
            <div class="flex items-center gap-3 min-w-0">
                <div class="relative w-10 h-10 rounded-lg overflow-hidden border border-teal-100 flex-shrink-0 bg-gray-50 cursor-pointer group"
                     onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})">
                    <img src="{{ $saved }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $label }}">
                    <div class="absolute inset-0 bg-teal-500/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-teal-50 text-teal-600 border border-teal-200/60">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Saved
                </span>
            </div>
            <div class="flex items-center gap-1.5 flex-shrink-0 ml-2">
                <button type="button"
                        onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})"
                        class="px-2.5 py-1 text-xs font-bold text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-lg transition-colors flex items-center gap-1 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View
                </button>
                <label class="px-2.5 py-1 text-xs font-bold text-slate-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg cursor-pointer transition-colors flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Change
                    <input type="file" wire:model="{{ $id }}" accept="{{ $accept }}" class="hidden">
                </label>
            </div>
        </div>

    @elseif($file && ! is_string($file))
        {{-- ── State 2: File chosen, pending save ── --}}
        @php
            $previewUrl = null;
            if (is_object($file) && method_exists($file, 'temporaryUrl')) {
                try { $previewUrl = $file->temporaryUrl(); } catch (\Throwable) {}
            }
        @endphp
        <div class="flex items-center justify-between p-2.5 bg-amber-50/70 border border-amber-200 rounded-xl shadow-sm">
            <div class="flex items-center gap-2.5 min-w-0">
                @if($previewUrl)
                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-amber-200 flex-shrink-0 cursor-pointer"
                         onclick="window.openDocModal({{ json_encode($previewUrl) }}, {{ json_encode($label) }})">
                        <img src="{{ $previewUrl }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-10 h-10 rounded-lg bg-amber-100 border border-amber-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                <div class="min-w-0">
                    <p class="text-xs font-bold text-gray-800 truncate max-w-[110px] sm:max-w-[150px]">
                        {{ is_object($file) && method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : 'File Selected' }}
                    </p>
                    <span class="text-[10px] text-amber-600 font-medium">Ready to save</span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 flex-shrink-0 ml-2">
                @if($previewUrl)
                    <button type="button"
                            onclick="window.openDocModal({{ json_encode($previewUrl) }}, {{ json_encode($label) }})"
                            class="px-2 py-1 text-xs font-bold text-amber-700 bg-amber-100 hover:bg-amber-200 rounded-lg transition-colors flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View
                    </button>
                @endif
                <button type="button"
                        wire:click="saveSingleDocument('{{ $id }}')"
                        wire:loading.attr="disabled"
                        class="px-3 py-1 text-xs font-bold text-white bg-teal-600 hover:bg-teal-500 active:bg-teal-700 rounded-lg transition-all flex items-center gap-1 shadow-sm">
                    <svg wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')">Save</span>
                    <svg wire:loading wire:target="saveSingleDocument('{{ $id }}')" class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading wire:target="saveSingleDocument('{{ $id }}')">Saving...</span>
                </button>
            </div>
        </div>

    @else
        {{-- ── State 3: Empty picker ── --}}
        <div class="relative group">
            <input type="file" wire:model="{{ $id }}" accept="{{ $accept }}"
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <div class="flex items-center justify-between p-2.5 bg-gray-50/80 hover:bg-teal-50/40 border border-gray-200 border-dashed group-hover:border-teal-400 rounded-xl transition-all">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 group-hover:border-teal-200 text-gray-400 group-hover:text-teal-500 flex items-center justify-center transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-600 group-hover:text-teal-600 transition-colors">
                            {{ $label }}
                            @if($required) <span class="text-rose-500 ml-0.5">*</span> @endif
                        </p>
                        <p class="text-[10px] text-gray-400">JPG, PNG (Max 2MB)</p>
                    </div>
                </div>
                <span wire:loading.remove wire:target="{{ $id }}"
                      class="text-xs font-semibold text-gray-500 group-hover:text-teal-600 bg-white group-hover:bg-teal-50 px-2.5 py-1 rounded-md border border-gray-200 group-hover:border-teal-200 transition-all">
                    Browse
                </span>
                <span wire:loading wire:target="{{ $id }}" class="flex items-center gap-1.5 text-xs text-teal-600 font-semibold">
                    <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                </span>
            </div>
        </div>
    @endif
</div>
