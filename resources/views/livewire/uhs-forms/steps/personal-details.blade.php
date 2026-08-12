<form wire:submit="submit" class="space-y-6">
    @include('livewire.partials.validation-errors')
    <div class="border-b border-slate-800 pb-4">
        <h2 class="text-xl font-bold text-slate-100">Step 2: Personal Information</h2>
        <p class="text-slate-400 text-sm">Provide your full personal details accurately as per your CNIC/Passport.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Candidate Full Name <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="name" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('name') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Father's Name <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="fatherName" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('fatherName') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mother's Name <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="motherName" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('motherName') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Date of Birth <span class="text-rose-500">*</span></label>
            <input type="date" wire:model="dob" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('dob') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Gender <span class="text-rose-500">*</span></label>
            <select wire:model="genderId" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                <option value="">Select Gender</option>
                @foreach($genders as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
            @error('genderId') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Residence Area <span class="text-rose-500">*</span></label>
            <select wire:model="residenceId" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                <option value="">Select Residence Area</option>
                @foreach($residenceAreas as $ra)
                    <option value="{{ $ra->id }}">{{ $ra->name }}</option>
                @endforeach
            </select>
            @error('residenceId') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mobile Number <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="mobileNumber" placeholder="03001234567" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('mobileNumber') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email Address <span class="text-rose-500">*</span></label>
            <input type="email" wire:model="email" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('email') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">CNIC / Passport Type <span class="text-rose-500">*</span></label>
            <select wire:model="cnic" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                <option value="">Select ID Document</option>
                @foreach($cnicPassports as $cp)
                    <option value="{{ $cp->id }}">{{ $cp->name }}</option>
                @endforeach
            </select>
            @error('cnic') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">CNIC / Passport Number <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="cnic_passport" placeholder="35201-1234567-1" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('cnic_passport') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nationality <span class="text-rose-500">*</span></label>
            <select wire:model="nationalityId" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                <option value="">Select Nationality</option>
                @foreach($nationalities as $n)
                    <option value="{{ $n->id }}">{{ $n->name }}</option>
                @endforeach
            </select>
            @error('nationalityId') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Domicile District</label>
            <select wire:model="domicile" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
                <option value="">Select Domicile</option>
                @foreach($districts as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">City <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="city" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('city') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Country <span class="text-rose-500">*</span></label>
            <input type="text" wire:model="country" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-indigo-500">
            @error('country') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Permanent Address <span class="text-rose-500">*</span></label>
            <textarea wire:model="address" rows="3" class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-sm text-slate-100 focus:outline-none focus:border-indigo-500"></textarea>
            @error('address') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="flex justify-end pt-6 border-t border-slate-800">
        <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center space-x-2">
            <span wire:loading.inline wire:target="submit" class="mr-2">
                <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </span>
            <span wire:loading.remove.delay wire:target="submit">Save & Proceed to Academic Qualification</span>
            <span wire:loading.delay wire:target="submit">Saving...</span>
        </button>
    </div>
</form>
