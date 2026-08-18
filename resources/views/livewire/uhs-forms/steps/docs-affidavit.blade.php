<form wire:submit="submit" class="space-y-8">

    <!-- Header -->
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 5: Document Uploads & Affidavit</h2>
        <p class="text-slate-400 text-sm">Upload clear scanned copies (JPG, PNG) of your original documents. You can save each document individually.</p>
    </div>

    <!-- Identity Documents -->
    <div class="space-y-4">
        <div class="flex items-center gap-2 pb-1 border-b border-slate-800/60">
            <div class="w-7 h-7 rounded-lg bg-indigo-500/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest">Identity Documents</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">CNIC / Passport — Front <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="cnic"
                    :file="$cnic"
                    :saved="$savedCnic"
                    label="CNIC / Passport Front"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">CNIC / Passport — Back <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="cnicBack"
                    :file="$cnicBack"
                    :saved="$savedCnicBack"
                    label="CNIC / Passport Back"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Father's CNIC — Front <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="fatherCnic"
                    :file="$fatherCnic"
                    :saved="$savedFatherCnic"
                    label="Father's CNIC Front"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Father's CNIC — Back <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="fatherCnicBack"
                    :file="$fatherCnicBack"
                    :saved="$savedFatherCnicBack"
                    label="Father's CNIC Back"
                    required />
            </div>
        </div>
    </div>

    <!-- Personal Photos -->
    <div class="space-y-4">
        <div class="flex items-center gap-2 pb-1 border-b border-slate-800/60">
            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest">Personal Photo & Signature</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Passport Size / Color Photo <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="photo"
                    :file="$photo"
                    :saved="$savedPhoto"
                    label="Passport Size Photo"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Digital Signature <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="signature"
                    :file="$signature"
                    :saved="$savedSignature"
                    label="Signature Image"
                    required />
            </div>
        </div>
    </div>

    <!-- Academic Certificates -->
    <div class="space-y-4">
        <div class="flex items-center gap-2 pb-1 border-b border-slate-800/60">
            <div class="w-7 h-7 rounded-lg bg-amber-500/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest">Academic Certificates & Transcripts</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Matric / SSC Transcript <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="matricTranscript"
                    :file="$matricTranscript"
                    :saved="$savedMatricTranscript"
                    label="Matric / SSC Transcript"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">F.Sc / HSSC Transcript <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="intermediateTranscript"
                    :file="$intermediateTranscript"
                    :saved="$savedIntermediateTranscript"
                    label="F.Sc / HSSC Transcript"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">Domicile Certificate <span class="text-rose-500">*</span></label>
                <x-file-upload
                    id="domicile"
                    :file="$domicile"
                    :saved="$savedDomicile"
                    label="Domicile Certificate"
                    required />
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-400">MDCAT / Entry Test Result Card</label>
                <x-file-upload
                    id="mdcatResult"
                    :file="$mdcatResult"
                    :saved="$savedMdcatResult"
                    label="MDCAT / Entry Test Result Card" />
            </div>
        </div>
    </div>

    <!-- Other Documents -->
    <div class="space-y-3">
        <div class="flex items-center justify-between pb-1 border-b border-slate-800/60">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-purple-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest">Other Documents</h3>
                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $otherDocumentsEnabled ? 'Required — add at least one document' : 'Optional — add any additional supporting documents' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 cursor-pointer px-3 py-1.5 rounded-lg border border-purple-500/30 hover:bg-purple-500/5 transition-all"
                       title="{{ $otherDocumentsEnabled ? 'Disable Other Documents (optional)' : 'Enable Other Documents (at least one required)' }}">
                    <input type="checkbox" wire:model.live="otherDocumentsEnabled"
                           class="w-4 h-4 rounded border-purple-400 text-purple-600 focus:ring-purple-500 bg-slate-950 cursor-pointer">
                    <span class="text-xs font-semibold {{ $otherDocumentsEnabled ? 'text-purple-400' : 'text-slate-500' }}">
                        {{ $otherDocumentsEnabled ? 'Enabled' : 'Enable' }}
                    </span>
                </label>

                <button type="button" wire:click="addOtherDocument" {{ !$otherDocumentsEnabled ? 'disabled' : '' }}
                    class="flex items-center gap-1.5 text-xs font-bold text-purple-400 hover:text-purple-300 bg-purple-500/10 hover:bg-purple-500/20 border border-purple-500/30 px-3 py-1.5 rounded-lg transition-all
                        {{ !$otherDocumentsEnabled ? 'opacity-50 cursor-not-allowed' : '' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Document
                </button>
            </div>
        </div>

        {{-- Validation error --}}
        @error('otherDocuments')
            <div class="flex items-start gap-2 px-3 py-2 bg-rose-500/10 border border-rose-500/30 rounded-lg">
                <svg class="w-4 h-4 text-rose-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <span class="text-[11px] text-rose-400">{{ $message }}</span>
            </div>
        @enderror

        {{-- Table --}}
        <div class="bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden
            {{ !$otherDocumentsEnabled ? 'opacity-60 pointer-events-none' : '' }}">

            {{-- Column headers --}}
            <div class="grid grid-cols-12 gap-3 px-4 py-2.5 bg-slate-950/60 border-b border-slate-800">
                <div class="col-span-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">#</div>
                <div class="col-span-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    Document Name
                    @if($otherDocumentsEnabled)
                        <span class="text-rose-500 ml-1">*</span>
                    @endif
                </div>
                <div class="col-span-5 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    File
                    @if($otherDocumentsEnabled)
                        <span class="text-rose-500 ml-1">*</span>
                    @endif
                </div>
                <div class="col-span-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest text-right">Actions</div>
            </div>

            {{-- Rows --}}
            @foreach($otherDocuments as $index => $doc)
                <div class="grid grid-cols-12 gap-3 px-4 py-3 items-center
                    {{ ! $loop->last ? 'border-b border-slate-800/50' : '' }}
                    {{ $doc['savedUrl'] ? 'bg-teal-500/3' : '' }}
                    {{ $otherDocumentsEnabled && $index === 0 ? 'bg-purple-500/5' : '' }}">

                    {{-- # --}}
                    <div class="col-span-1">
                        <span class="w-6 h-6 rounded-md bg-slate-800 text-slate-500 text-[11px] font-bold flex items-center justify-center">
                            {{ $index + 1 }}
                            @if($otherDocumentsEnabled && $index === 0)
                                <span class="text-rose-500 ml-0.5">*</span>
                            @endif
                        </span>
                    </div>

                    {{-- Name --}}
                    <div class="col-span-4">
                        @if($doc['savedUrl'])
                            <span class="text-sm font-semibold text-slate-200 truncate block">{{ $doc['savedName'] }}</span>
                        @else
                            <input
                                type="text"
                                wire:model="otherDocuments.{{ $index }}.docName"
                                placeholder="e.g. NOC, Experience Certificate..."
                                class="w-full bg-slate-950 border rounded-lg px-3 py-1.5 text-xs text-slate-100 placeholder-slate-600 focus:outline-none transition-colors
                                    {{ $errors->has('otherDocuments.'.$index.'.docName') ? '!border-rose-500 focus:!border-rose-500 focus:ring-rose-500/20' : 'border-slate-700 focus:border-purple-500' }}
                                    {{ $otherDocumentsEnabled && $index === 0 && empty(trim($doc['docName'] ?? '')) ? 'ring-1 ring-rose-500/30' : '' }}">
                            @error('otherDocuments.'.$index.'.docName')
                                <span class="text-[10px] text-rose-400 mt-1 block font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.313 10.899a1 1 0 00-1.414 1.414l5.5 5.5a1 1 0 001.414 0l8.102-8.102z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                            {{-- Show "required" for ALL rows if they have validation errors --}}
                            @if(!$errors->has('otherDocuments.'.$index.'.docName') && $otherDocumentsEnabled && $index === 0 && empty(trim($doc['docName'] ?? '')))
                                <span class="text-[10px] text-rose-400 mt-1 block font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.313 10.899a1 1 0 00-1.414 1.414l5.5 5.5a1 1 0 001.414 0l8.102-8.102z" clip-rule="evenodd"/>
                                    </svg>
                                    This field is required
                                </span>
                            @endif
                        @endif
                    </div>

                    {{-- File --}}
                    <div class="col-span-5">
                        @if($doc['savedUrl'])
                            {{-- Saved --}}
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg overflow-hidden border border-teal-200/50 flex-shrink-0 cursor-pointer"
                                     onclick="window.openDocModal('{{ $doc['savedUrl'] }}', '{{ $doc['savedName'] }}')">
                                    <img src="{{ $doc['savedUrl'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform" alt="">
                                </div>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-teal-50 text-teal-600 border border-teal-200/60">
                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Saved
                                </span>
                            </div>

                        @elseif($doc['file'])
                            {{-- Pending save --}}
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] text-amber-500 font-semibold bg-amber-500/10 border border-amber-500/20 px-2 py-1 rounded-lg">
                                    File ready — click Save →
                                </span>
                            </div>

                        @else
                            {{-- Empty picker --}}
                            <div class="relative group">
                                <input type="file"
                                       wire:model="otherDocuments.{{ $index }}.file"
                                       accept="image/*"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="flex items-center gap-2 px-3 py-1.5 border border-dashed rounded-lg bg-slate-950/40 transition-all
                                    {{ $errors->has('otherDocuments.'.$index.'.file') ? 'border-rose-500/60 bg-rose-500/5' : 'border-slate-700 group-hover:border-purple-500/50 group-hover:bg-purple-500/5' }}
                                    {{ $otherDocumentsEnabled && $index === 0 && empty($doc['file']) ? 'ring-1 ring-rose-500/30' : '' }}">
                                    <svg class="w-3.5 h-3.5 transition-colors flex-shrink-0
                                        {{ $errors->has('otherDocuments.'.$index.'.file') ? 'text-rose-400' : 'text-slate-600 group-hover:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span wire:loading.remove wire:target="otherDocuments.{{ $index }}.file"
                                          class="text-xs transition-colors truncate
                                        {{ $errors->has('otherDocuments.'.$index.'.file') ? 'text-rose-400' : 'text-slate-500 group-hover:text-purple-400' }}">
                                        Choose file...
                                    </span>
                                    <span wire:loading wire:target="otherDocuments.{{ $index }}.file"
                                          class="text-xs text-purple-400 flex items-center gap-1">
                                        <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                        </svg>
                                        Loading...
                                    </span>
                                </div>
                            </div>
                            @error('otherDocuments.'.$index.'.file')
                                <span class="text-[10px] text-rose-400 mt-1 block font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.313 10.899a1 1 0 00-1.414 1.414l5.5 5.5a1 1 0 001.414 0l8.102-8.102z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                            {{-- Show "required" for row 1 if enabled and empty (before submit) --}}
                            @if(!$errors->has('otherDocuments.'.$index.'.file') && $otherDocumentsEnabled && $index === 0 && empty($doc['file']))
                                <span class="text-[10px] text-rose-400 mt-1 block font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.313 10.899a1 1 0 00-1.414 1.414l5.5 5.5a1 1 0 001.414 0l8.102-8.102z" clip-rule="evenodd"/>
                                    </svg>
                                    This field is required
                                </span>
                            @endif
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="col-span-2 flex items-center justify-end gap-1.5">
                        @if($doc['savedUrl'])
                            {{-- View + Change --}}
                            <button type="button"
                                    onclick="window.openDocModal('{{ $doc['savedUrl'] }}', '{{ $doc['savedName'] }}')"
                                    class="w-7 h-7 rounded-lg bg-slate-800 hover:bg-teal-500/20 text-slate-400 hover:text-teal-400 transition-all flex items-center justify-center"
                                    title="View">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                        @elseif($doc['file'])
                            {{-- Save button --}}
                            <button type="button"
                                    wire:click="saveOtherDocument({{ $index }})"
                                    wire:loading.attr="disabled"
                                    class="h-7 px-2.5 rounded-lg bg-teal-600 hover:bg-teal-500 text-white text-[10px] font-bold transition-all flex items-center gap-1 shadow-sm">
                                <svg wire:loading.remove wire:target="saveOtherDocument({{ $index }})" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <svg wire:loading wire:target="saveOtherDocument({{ $index }})" class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="saveOtherDocument({{ $index }})">Save</span>
                            </button>
                        @endif

                        {{-- Delete --}}
                        <button type="button"
                                wire:click="removeOtherDocument({{ $index }})"
                                wire:confirm="Remove this document?"
                                class="w-7 h-7 rounded-lg hover:bg-rose-500/10 text-slate-600 hover:text-rose-400 transition-all flex items-center justify-center"
                                title="Remove">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>

                </div>
            @endforeach

        </div>
    </div>

    <!-- Upload progress indicator -->
    @php
        $savedCount  = collect([
            $savedCnic, $savedCnicBack, $savedFatherCnic, $savedFatherCnicBack,
            $savedSignature, $savedPhoto, $savedDomicile,
            $savedMatricTranscript, $savedIntermediateTranscript, $savedMdcatResult,
        ])->filter()->count();
        $otherSaved  = collect($otherDocuments)->filter(fn($d) => ! empty($d['savedUrl']))->count();
        $totalDocs   = 10 + $otherSaved;
        $savedCount  = $savedCount + $otherSaved;
        $progress    = $totalDocs > 0 ? round(($savedCount / $totalDocs) * 100) : 0;
    @endphp
    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-4 space-y-2">
        <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400 font-medium">Documents saved</span>
            <span class="font-bold {{ $savedCount === $totalDocs ? 'text-emerald-400' : 'text-indigo-400' }}">
                {{ $savedCount }} / {{ $totalDocs }}
            </span>
        </div>
        <div class="h-1.5 bg-slate-800 rounded-full overflow-hidden">
            <div class="h-full rounded-full transition-all duration-500
                {{ $savedCount === $totalDocs ? 'bg-emerald-500' : 'bg-indigo-500' }}"
                style="width: {{ $progress }}%">
            </div>
        </div>
        @if($savedCount === $totalDocs)
            <p class="text-[11px] text-emerald-400 font-medium flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                All documents uploaded!
            </p>
        @else
            <p class="text-[11px] text-slate-500">Save each document using the "Save" button before submitting.</p>
        @endif
    </div>

    <!-- Undertaking & Declaration -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 space-y-4">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-rose-500/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest">Undertaking & Final Declaration</h3>
        </div>

        <label class="flex items-start gap-3 cursor-pointer group">
            <input type="checkbox" wire:model="terms" value="1"
                class="mt-0.5 w-4 h-4 rounded border-slate-700 text-indigo-600 focus:ring-indigo-500 bg-slate-950 flex-shrink-0
                {{ $errors->has('terms') ? 'border-rose-500' : '' }}">
            <span class="text-xs text-slate-300 leading-relaxed group-hover:text-slate-200 transition-colors">
                I solemnly declare that all the information provided by me in this form is accurate and complete. If any document or statement is found forged or false at any stage, my application/admission shall be liable to immediate cancellation.
            </span>
        </label>
        @error('terms')
            <p class="text-xs text-rose-400 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                You must accept the declaration to proceed.
            </p>
        @enderror
    </div>

    <!-- Navigation -->
    <div class="pt-6 flex justify-between gap-4 border-t border-slate-800">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold shadow-lg shadow-emerald-600/30 transition-all flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <svg wire:loading.remove wire:target="submit" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span wire:loading.remove wire:target="submit">Save & Proceed to Review</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>

</form>
