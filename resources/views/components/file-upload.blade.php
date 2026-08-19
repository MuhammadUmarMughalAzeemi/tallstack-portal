@props([
    'id',
    'file'     => null,
    'saved'    => null,
    'required' => false,
    'label'    => 'Upload Image',
    'accept'   => 'image/*',
    'error'    => null,
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
@endphp

<div
    class="w-full font-sans"
    wire:key="upload-{{ $id }}-{{ $saved ? 'saved' : ($isPending ? 'pending' : 'empty') }}"
    x-data="{ progress: 0, uploading: false }"
    x-on:livewire-upload-start="$event.target.matches('[data-upload-field=\'{{ $id }}\']') && (uploading = true, progress = 0)"
    x-on:livewire-upload-progress="$event.target.matches('[data-upload-field=\'{{ $id }}\']') && (progress = $event.detail.progress)"
    x-on:livewire-upload-error="$event.target.matches('[data-upload-field=\'{{ $id }}\']') && (uploading = false, progress = 0)"
    x-on:livewire-upload-finish="$event.target.matches('[data-upload-field=\'{{ $id }}\']') && (uploading = false, progress = 100)"
>
    @if($saved && ! $isPending)
        <div @class([
            'relative overflow-hidden rounded-xl border shadow-sm transition-all',
            'border-emerald-500/30 bg-slate-900/50 hover:border-emerald-500/50 light:bg-white light:border-emerald-200 light:hover:border-emerald-400' => ! $hasError,
            'border-rose-500/60 bg-rose-500/5 light:bg-rose-50' => $hasError,
        ])>
            <div class="flex items-center justify-between p-2.5">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="relative w-10 h-10 rounded-lg overflow-hidden border border-slate-700 flex-shrink-0 bg-slate-800 cursor-pointer group light:border-slate-200 light:bg-slate-50"
                         onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})">
                        <img src="{{ $saved }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $label }}">
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 light:bg-emerald-50 light:text-emerald-700 light:border-emerald-200">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Saved
                    </span>
                </div>
                <div class="flex items-center gap-1.5 flex-shrink-0 ml-2">
                    <button type="button"
                            onclick="window.openDocModal({{ json_encode($saved) }}, {{ json_encode($label) }})"
                            class="px-2.5 py-1 text-xs font-bold text-primary-400 bg-primary-500/10 hover:bg-primary-500/20 rounded-lg transition-colors flex items-center gap-1 light:text-primary-600 light:bg-primary-50 light:hover:bg-primary-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View
                    </button>
                    <label class="px-2.5 py-1 text-xs font-bold text-slate-300 bg-slate-800 hover:bg-slate-700 border border-slate-600 rounded-lg cursor-pointer transition-colors flex items-center gap-1 light:text-slate-600 light:bg-slate-50 light:hover:bg-slate-100 light:border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Change
                        <input type="file" wire:model="{{ $id }}" accept="{{ $accept }}" data-upload-field="{{ $id }}" class="hidden">
                    </label>
                </div>
            </div>

            <div x-show="uploading" x-cloak class="border-t border-primary-500/20 bg-primary-500/10 light:border-primary-100 light:bg-primary-50/80">
                <p class="px-2.5 pt-1.5 text-[10px] text-primary-400 font-medium light:text-primary-600" x-text="'Uploading ' + progress + '%'"></p>
                <div class="h-1.5 bg-slate-800 light:bg-slate-100">
                    <div class="h-full bg-primary-600 transition-all duration-150 ease-out" :style="`width: ${progress}%`"></div>
                </div>
            </div>
        </div>

    @elseif($isPending)
        <div class="relative overflow-hidden rounded-xl border border-amber-500/40 bg-slate-900/50 shadow-sm light:border-amber-200 light:bg-white">
            <div class="flex items-center justify-between p-2.5 gap-2">
                <div class="flex items-center gap-2.5 min-w-0">
                    @if($previewUrl)
                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-amber-500/30 flex-shrink-0 light:border-amber-100">
                            <img src="{{ $previewUrl }}" class="w-full h-full object-cover" alt="">
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center flex-shrink-0 light:bg-amber-50 light:border-amber-100">
                            <svg class="w-5 h-5 text-amber-400 light:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-slate-200 truncate max-w-[120px] sm:max-w-[160px] light:text-slate-800">
                            {{ is_object($file) && method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : 'File ready' }}
                        </p>
                        <p class="text-[10px] text-amber-400 font-medium light:text-amber-600">Ready — click Save to confirm</p>
                    </div>
                </div>
                <button type="button"
                        wire:click="saveSingleDocument('{{ $id }}')"
                        wire:loading.attr="disabled"
                        wire:target="saveSingleDocument('{{ $id }}')"
                        class="flex-shrink-0 px-3 py-1.5 text-xs font-bold text-white bg-primary-600 hover:bg-primary-700 rounded-lg shadow-sm shadow-primary-600/30 transition-colors flex items-center gap-1.5 disabled:opacity-60">
                    <svg wire:loading wire:target="saveSingleDocument('{{ $id }}')" class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <svg wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span wire:loading.remove wire:target="saveSingleDocument('{{ $id }}')" class="text-white">Save</span>
                    <span wire:loading wire:target="saveSingleDocument('{{ $id }}')" class="text-white">Saving...</span>
                </button>
            </div>
        </div>

    @else
        <div class="relative group">
            <input type="file"
                   wire:model="{{ $id }}"
                   accept="{{ $accept }}"
                   data-upload-field="{{ $id }}"
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <div @class([
                'relative overflow-hidden rounded-xl border border-dashed transition-all',
                'bg-slate-900/40 hover:bg-slate-800/50 border-slate-700 group-hover:border-primary-500/50 light:bg-slate-50/80 light:hover:bg-primary-50/40 light:border-slate-300 light:group-hover:border-primary-400' => ! $hasError,
                'bg-rose-500/5 border-rose-500/60 light:bg-rose-50' => $hasError,
            ])>
                <div class="flex items-center justify-between p-2.5">
                    <div class="flex items-center gap-2.5">
                        <div @class([
                            'w-8 h-8 rounded-lg flex items-center justify-center transition-colors shadow-sm border',
                            'bg-slate-800 border-slate-600 text-slate-400 group-hover:border-primary-500/40 group-hover:text-primary-400 light:bg-white light:border-slate-200 light:group-hover:border-primary-200 light:group-hover:text-primary-500' => ! $hasError,
                            'bg-rose-500/10 border-rose-400/40 text-rose-400' => $hasError,
                        ])>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <div>
                            <p @class([
                                'text-xs font-bold transition-colors',
                                'text-slate-300 group-hover:text-primary-400 light:text-slate-600 light:group-hover:text-primary-600' => ! $hasError,
                                'text-rose-400' => $hasError,
                            ])>
                                {{ $label }}
                                @if($required) <span class="text-rose-500 ml-0.5">*</span> @endif
                            </p>
                            <p class="text-[10px] text-slate-500 light:text-slate-400">
                                <span x-show="!uploading">JPG, PNG (Max 2MB)</span>
                                <span x-show="uploading" x-cloak x-text="'Uploading ' + progress + '%'" class="text-primary-400 font-medium light:text-primary-600"></span>
                            </p>
                        </div>
                    </div>
                    <span x-show="!uploading" class="text-xs font-semibold text-slate-400 group-hover:text-primary-400 bg-slate-800 group-hover:bg-primary-500/10 px-2.5 py-1 rounded-md border border-slate-600 group-hover:border-primary-500/30 transition-all light:text-slate-500 light:group-hover:text-primary-600 light:bg-white light:group-hover:bg-primary-50 light:border-slate-200 light:group-hover:border-primary-200">
                        Browse
                    </span>
                </div>

                <div class="h-1.5 bg-slate-800 light:bg-slate-100" x-show="uploading" x-cloak>
                    <div class="h-full bg-primary-600 transition-all duration-150 ease-out" :style="`width: ${progress}%`"></div>
                </div>
            </div>
        </div>
    @endif

    @if($hasError)
        <p class="text-[11px] text-rose-400 mt-1.5 font-medium flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            {{ $error }}
        </p>
    @endif
</div>
