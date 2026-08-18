<form wire:submit="submit" class="space-y-8">
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 2: Personal Information</h2>
        <p class="text-slate-400 text-sm">Provide your full personal details accurately as per your CNIC/Passport.</p>
    </div>

    <!-- Basic Information Section -->
    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-6 space-y-6">
        <div class="flex items-center gap-3 pb-3 border-b border-slate-800/50">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-100">Basic Information</h3>
                <p class="text-xs text-slate-400">Full name and family details</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Candidate Full Name <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="name"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('name') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('name') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Father's Name <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="fatherName"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('fatherName') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('fatherName') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mother's Name <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="motherName"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('motherName') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('motherName') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Date of Birth <span class="text-rose-500">*</span></label>
                <input type="date" wire:model="dob"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('dob') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('dob') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Gender <span class="text-rose-500">*</span></label>
                <select wire:model="genderId"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('genderId') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Gender</option>
                    @foreach($genders as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </select>
                @error('genderId') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Residence Area <span class="text-rose-500">*</span></label>
                <select wire:model="residenceId"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('residenceId') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Residence Area</option>
                    @foreach($residenceAreas as $ra)
                        <option value="{{ $ra->id }}">{{ $ra->name }}</option>
                    @endforeach
                </select>
                @error('residenceId') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Contact Information Section -->
    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-6 space-y-6">
        <div class="flex items-center gap-3 pb-3 border-b border-slate-800/50">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-100">Contact Information</h3>
                <p class="text-xs text-slate-400">Email and mobile number</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mobile Number <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="mobileNumber" placeholder="03001234567"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('mobileNumber') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('mobileNumber') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email Address <span class="text-rose-500">*</span></label>
                <input type="email" wire:model.blur="email"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('email') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('email') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Identity Documents Section -->
    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-6 space-y-6">
        <div class="flex items-center gap-3 pb-3 border-b border-slate-800/50">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-100">Identity Documents</h3>
                <p class="text-xs text-slate-400">CNIC/Passport and nationality details</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">CNIC / Passport Type</label>
                <div class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-400 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>{{ $cnicTypeName ?? 'Not Selected' }}</span>
                </div>
                <p class="text-xs text-slate-500 mt-1.5">Selected during registration</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">CNIC / Passport Number <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="cnic_passport" placeholder="35201-1234567-1"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('cnic_passport') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('cnic_passport') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nationality <span class="text-rose-500">*</span></label>
                <select wire:model="nationalityId"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('nationalityId') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Nationality</option>
                    @foreach($nationalities as $n)
                        <option value="{{ $n->id }}">{{ $n->name }}</option>
                    @endforeach
                </select>
                @error('nationalityId') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Domicile District</label>
                <select wire:model="domicile"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('domicile') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                    <option value="">Select Domicile</option>
                    @foreach($districts as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
                @error('domicile') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Address Section -->
    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-6 space-y-6">
        <div class="flex items-center gap-3 pb-3 border-b border-slate-800/50">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-100">Residential Address</h3>
                <p class="text-xs text-slate-400">City, country and permanent address</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">City <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="city"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('city') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('city') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Country <span class="text-rose-500">*</span></label>
                <input type="text" wire:model.blur="country"
                    class="w-full bg-slate-950 border rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('country') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}">
                @error('country') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Permanent Address <span class="text-rose-500">*</span></label>
                <textarea wire:model.blur="address" rows="3"
                    class="w-full bg-slate-950 border rounded-xl p-3 text-sm text-slate-100 focus:outline-none transition-colors
                    {{ $errors->has('address') ? 'border-rose-500 focus:border-rose-400' : 'border-slate-800 focus:border-indigo-500' }}"></textarea>
                @error('address') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-between pt-6 border-t border-slate-800">
        <button type="button" wire:click="back" wire:loading.attr="disabled"
            class="h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 disabled:opacity-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back
        </button>

        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
            class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-2 disabled:opacity-60 disabled:cursor-not-allowed">
            <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="submit">Save & Proceed to Academic Qualification</span>
            <span wire:loading wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
