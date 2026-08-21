@props([
    'id',
    'file'         => null,
    'saved'        => null,
    'required'     => false,
    'label'        => 'Upload Image',
    'accept'       => 'image/*',
    'error'        => null,
    'instruction'  => null,
    'instructions' => null,
])

@php
    $isPending = $file && ! is_string($file);
    $hasError = filled($error);
    $previewUrl = null;

    if ($isPending && is_object($file) && method_exists($file, 'temporaryUrl')) {
        try {
            $previewUrl = $file->temporaryUrl();
        } catch (\Throwable) {
        }
    }

    $defaultInstruction = $instruction ?? 'JPG, PNG (Max 2MB) • Scanned color copy';

    $savedFileName = null;
    if ($saved) {
        $parsedPath = parse_url($saved, PHP_URL_PATH) ?? $saved;
        $savedFileName = urldecode(basename($parsedPath));
    }
@endphp

<div
    class="w-full font-sans"
    wire:key="upload-{{ $id }}-{{ $isPending ? 'pending' : ($saved ? 'saved' : 'empty') }}"
    x-data="{ progress: 0, uploading: false }"
    x-on:livewire-upload-start="if ($el.contains($event.target) || ($event.target && $event.target.matches && $event.target.matches('[data-upload-field=\'{{ $id }}\']'))) { uploading = true; progress = 0; }"
    x-on:livewire-upload-progress="if ($el.contains($event.target) || ($event.target && $event.target.matches && $event.target.matches('[data-upload-field=\'{{ $id }}\']'))) { progress = $event.detail.progress; }"
    x-on:livewire-upload-error="uploading = false; progress = 0;"
    x-on:livewire-upload-finish="uploading = false; progress = 0;"
    x-on:livewire-upload-cancel="uploading = false; progress = 0;"
>
    {{-- ========================================================================= --}}
    {{-- SAVED STATE: 100% Solid (No Transparencies), SaaS Left-Accent & Badges    --}}
    {{-- ========================================================================= --}}
    @if($saved && ! $isPending)
        <div @class([
            'relative overflow-hidden rounded-xl border border-l-4 shadow-sm transition-all p-2.5 space-y-2',
            'border-slate-700 border-l-emerald-500 bg-slate-900 hover:border-slate-600 light:bg-white light:border-slate-300 light:border-l-emerald-600 light:hover:border-slate-400' => ! $hasError,
            'border-rose-500 border-l-rose-500 bg-rose-950/20 light:bg-rose-50 light:border-rose-300' => $hasError,
        ])>
            {{-- Top Row: Thumbnail, Label, Saved Badge & Action Buttons --}}
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <div class="relative w-11 h-11 rounded-lg overflow-hidden border border-slate-700 flex-shrink-0 bg-slate-800 cursor-pointer group light:border-slate-300 light:bg-slate-100"
                         onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})"
                         title="Click to view full preview">
                        <img src="{{ $saved }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $label }}">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <svg class="w-4 h-4 text-white drop-shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="text-xs font-bold text-slate-100 truncate light:text-slate-900">{{ $label }}</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-600 text-white shadow-sm">
                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Saved
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5 light:text-slate-600">
                            {{ $defaultInstruction }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-1.5 flex-shrink-0">
                    <button type="button"
                            onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})"
                            class="px-3 py-1.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg shadow-sm shadow-indigo-600/30 transition-all flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View
                    </button>
                    <label class="px-3 py-1.5 text-xs font-bold text-slate-200 bg-slate-800 hover:bg-slate-700 border border-slate-600 rounded-lg cursor-pointer transition-colors flex items-center gap-1.5 light:text-slate-800 light:bg-slate-100 light:hover:bg-slate-200 light:border-slate-300">
                        <svg class="w-3.5 h-3.5 text-slate-400 light:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Change
                        <input type="file" wire:model="{{ $id }}" accept="{{ $accept }}" data-upload-field="{{ $id }}" class="hidden">
                    </label>
                </div>
            </div>

            {{-- Bottom Specs / Verification Bar --}}
            <div class="flex items-center gap-1.5 pt-1.5 border-t border-slate-800 light:border-slate-200 flex-wrap">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-800 text-slate-200 border border-slate-700 light:bg-slate-100 light:text-slate-800 light:border-slate-300">
                    📄 JPG/PNG
                </span>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-800 text-slate-200 border border-slate-700 light:bg-slate-100 light:text-slate-800 light:border-slate-300">
                    ⚖ Max 2MB
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800 light:bg-emerald-100 light:text-emerald-900 light:border-emerald-300 max-w-full truncate" title="{{ $label }} Uploaded">
                    <svg class="w-3 h-3 text-emerald-400 light:text-emerald-700 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="truncate">✓ {{ $label }} Uploaded</span>
                </span>
            </div>

            {{-- Upload Progress --}}
            <div x-show="uploading" x-cloak class="border-t border-slate-700/60 light:border-slate-200 bg-slate-800/80 light:bg-slate-50 rounded-lg p-2 mt-1">
                <p class="text-[10px] text-indigo-400 font-bold light:text-indigo-700 mb-1" x-text="'Uploading ' + progress + '%'"></p>
                <div class="h-2 bg-slate-700 light:bg-slate-200 rounded-full overflow-hidden p-0.5 border border-slate-600/40 light:border-slate-300">
                    <div class="h-full rounded-full transition-all duration-150 ease-out" data-progress-bar-fill :style="`width: ${progress}%`"></div>
                </div>
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- PENDING STATE: Selected file ready to be confirmed & saved                --}}
    {{-- ========================================================================= --}}
    @elseif($isPending)
        <div class="relative overflow-hidden rounded-xl border border-l-4 border-slate-700 border-l-amber-500 bg-slate-900 shadow-sm p-2.5 space-y-2 light:border-slate-300 light:border-l-amber-500 light:bg-white">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-2.5 min-w-0">
                    @if($previewUrl)
                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-amber-500 flex-shrink-0 light:border-amber-400">
                            <img src="{{ $previewUrl }}" class="w-full h-full object-cover" alt="">
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-lg bg-amber-950 border border-amber-700 flex items-center justify-center flex-shrink-0 light:bg-amber-100 light:border-amber-300">
                            <svg class="w-5 h-5 text-amber-400 light:text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-slate-100 truncate max-w-[140px] sm:max-w-[200px] light:text-slate-900">
                            {{ is_object($file) && method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : 'File ready' }}
                        </p>
                        <p class="text-[11px] text-amber-400 font-semibold light:text-amber-700">Ready — click Save to confirm</p>
                    </div>
                </div>

                <button type="button"
                        wire:click="saveSingleDocument('{{ $id }}')"
                        wire:loading.attr="disabled"
                        wire:target="saveSingleDocument('{{ $id }}')"
                        class="flex-shrink-0 px-3.5 py-1.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg shadow-md shadow-indigo-600/30 transition-all flex items-center gap-1.5 disabled:opacity-60">
                    <svg wire:loading wire:target="saveSingleDocument('{{ $id }}')" class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <svg wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')">Save</span>
                    <span wire:loading wire:target="saveSingleDocument('{{ $id }}')">Saving...</span>
                </button>
            </div>

            <div class="flex items-center gap-1.5 pt-1.5 border-t border-slate-800 light:border-slate-200 flex-wrap text-[10px]">
                <span class="px-2 py-0.5 rounded font-bold bg-amber-950 text-amber-300 border border-amber-800 light:bg-amber-100 light:text-amber-900 light:border-amber-300">
                    ⚠️ Pending Confirmation
                </span>
                <span class="text-slate-400 light:text-slate-600 truncate">
                    • Click save button to upload file to your admission record
                </span>
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- EMPTY STATE: 100% Solid (No Transparencies), SaaS Left-Accent & Badges    --}}
    {{-- ========================================================================= --}}
    @else
        <div class="relative group">
            <input type="file"
                   wire:model="{{ $id }}"
                   accept="{{ $accept }}"
                   data-upload-field="{{ $id }}"
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <div @class([
                'relative overflow-hidden rounded-xl border border-l-4 transition-all p-2.5 space-y-2',
                'border-slate-700 border-l-indigo-600 bg-slate-900 hover:border-slate-600 light:border-slate-300 light:border-l-indigo-600 light:bg-white light:hover:border-slate-400' => ! $hasError,
                'border-rose-500 border-l-rose-500 bg-rose-950/20 light:bg-rose-50 light:border-rose-300' => $hasError,
            ])>
                {{-- Top Row: Icon, Label & Browse Button --}}
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div @class([
                            'w-8 h-8 rounded-lg flex items-center justify-center transition-colors shadow-sm border flex-shrink-0',
                            'bg-slate-800 border-slate-700 text-slate-300 light:bg-slate-100 light:border-slate-300 light:text-slate-700' => ! $hasError,
                            'bg-rose-900 text-rose-200 border-rose-700 light:bg-rose-100 light:text-rose-700 light:border-rose-300' => $hasError,
                        ])>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <p @class([
                            'text-xs font-bold transition-colors truncate',
                            'text-slate-100 light:text-slate-900' => ! $hasError,
                            'text-rose-400 light:text-rose-700' => $hasError,
                        ])>
                            {{ $label }}
                            @if($required) <span class="text-rose-500 ml-0.5">*</span> @endif
                        </p>
                    </div>

                    <span x-show="!uploading" class="text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 px-3.5 py-1.5 rounded-lg shadow-sm shadow-indigo-600/30 transition-all flex items-center gap-1.5 flex-shrink-0 cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Browse
                    </span>
                </div>

                {{-- Bottom Row: Structured Specification Badges & Guidelines --}}
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-800 text-slate-200 border border-slate-700 light:bg-slate-100 light:text-slate-800 light:border-slate-300">
                        📄 JPG/PNG
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-800 text-slate-200 border border-slate-700 light:bg-slate-100 light:text-slate-800 light:border-slate-300">
                        ⚖ ≤ 2MB
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-indigo-950 text-indigo-200 border border-indigo-800 light:bg-indigo-50 light:text-indigo-900 light:border-indigo-200 truncate max-w-[280px]">
                        🔍 {{ $defaultInstruction }}
                    </span>
                </div>

                {{-- Upload Progress --}}
                <div class="h-2 bg-slate-800/80 light:bg-slate-200 rounded-full overflow-hidden mt-1 p-0.5 border border-slate-700/40 light:border-slate-300" x-show="uploading" x-cloak>
                    <div class="h-full rounded-full transition-all duration-150 ease-out" data-progress-bar-fill :style="`width: ${progress}%`"></div>
                </div>
            </div>
        </div>
    @endif

    {{-- Error message --}}
    @if($hasError)
        <p class="text-[11px] text-rose-400 light:text-rose-700 mt-1.5 font-semibold flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            {{ $error }}
        </p>
    @endif
</div>
