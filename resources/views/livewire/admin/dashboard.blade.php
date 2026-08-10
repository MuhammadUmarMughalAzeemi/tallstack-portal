<x-skeuo-dashboard-styles />

<div class="admin-theme-container min-h-screen py-8 px-4 sm:px-6 lg:px-8 font-sans transition-all">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Main Header Banner (Skeuo-Glass Card) -->
        <div class="skeuo-glass-card p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold skeuo-text-heading tracking-tight flex items-center gap-2">
                    <span>✨ Post Graduate Admissions Admin Panel</span>
                </h1>
                <p class="text-xs sm:text-sm skeuo-text-subtext mt-1">Skeuomorphism & Glassmorphism Admin Engine • Light & Dark Mode Compatible • Candidate Management</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold skeuo-badge-success flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>System Admin Active</span>
                </span>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- 💎 ADMIN PANEL SKEUO-GLASS THEME SECTION (Separate Save)     -->
        <!-- ============================================================ -->
        <div class="skeuo-glass-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-300/40 dark:border-slate-800 pb-3">
                <div>
                    <h3 class="text-sm font-bold skeuo-text-heading uppercase tracking-wider flex items-center gap-2">
                        <span>💎 Admin Panel Skeuo-Glass Theme</span>
                    </h3>
                    <p class="text-xs skeuo-text-subtext">Select a glass theme preset for this Admin Control Panel. Changes apply instantly.</p>
                </div>
                @if($adminThemeSaved)
                    <div class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/40 text-emerald-600 dark:text-emerald-400 rounded-lg text-xs font-bold shadow-sm">
                        Admin Theme Saved &check;
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                <button wire:click="applyAdminTheme('custom-glass')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'custom-glass' ? 'border-amber-500 bg-amber-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-amber-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm animate-pulse"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-400 shadow-sm animate-pulse"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">✨ Custom Glass</span>
                </button>

                <button wire:click="applyAdminTheme('frost-sapphire')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'frost-sapphire' ? 'border-indigo-500 bg-indigo-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-indigo-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-indigo-500 shadow-sm"></span>
                        <span class="w-3 h-3 rounded-full bg-sky-400 shadow-sm"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">Frost Sapphire</span>
                </button>

                <button wire:click="applyAdminTheme('emerald-glass')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'emerald-glass' ? 'border-emerald-500 bg-emerald-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-emerald-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm"></span>
                        <span class="w-3 h-3 rounded-full bg-teal-400 shadow-sm"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">Emerald Glass</span>
                </button>

                <button wire:click="applyAdminTheme('obsidian-crystal')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'obsidian-crystal' ? 'border-purple-500 bg-purple-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-purple-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-purple-500 shadow-sm"></span>
                        <span class="w-3 h-3 rounded-full bg-fuchsia-400 shadow-sm"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">Obsidian Crystal</span>
                </button>

                <button wire:click="applyAdminTheme('luxe-gold')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'luxe-gold' ? 'border-amber-500 bg-amber-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-amber-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400 shadow-sm"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">Luxe Gold Glass</span>
                </button>

                <button wire:click="applyAdminTheme('rose-quartz')" class="p-3 rounded-xl border text-left transition-all cursor-pointer {{ $adminTheme === 'rose-quartz' ? 'border-rose-500 bg-rose-500/10 shadow-md font-bold' : 'border-slate-300 dark:border-slate-800 bg-slate-100/50 dark:bg-slate-900/50 hover:border-rose-400' }}">
                    <div class="flex items-center space-x-1.5 mb-1">
                        <span class="w-3 h-3 rounded-full bg-rose-500 shadow-sm"></span>
                        <span class="w-3 h-3 rounded-full bg-pink-400 shadow-sm"></span>
                    </div>
                    <span class="text-xs skeuo-text-heading">Rose Quartz</span>
                </button>
            </div>

            <div class="flex justify-end pt-2">
                <button wire:click="saveAdminTheme" class="skeuo-glass-btn-primary px-6 py-2.5 text-xs flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Admin Theme</span>
                </button>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- 🎓 STUDENT PORTAL THEME SECTION (Separate Save)              -->
        <!-- ============================================================ -->
        <div class="skeuo-glass-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-300/40 dark:border-slate-800 pb-3">
                <div>
                    <h3 class="text-sm font-bold skeuo-text-heading uppercase tracking-wider flex items-center gap-2">
                        <span>🎓 Student Portal Theme & Custom Palette</span>
                    </h3>
                    <p class="text-xs skeuo-text-subtext">Configure candidate form theme presets and custom @theme color palettes.</p>
                </div>
                @if($themeSaved)
                    <div class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/40 text-emerald-600 dark:text-emerald-400 rounded-lg text-xs font-bold shadow-sm">
                        Student Theme Saved &check;
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                <button wire:click="applyPrebuiltTheme('sapphire')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'sapphire' ? 'border-indigo-500 bg-indigo-500/10 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Midnight Sapphire</span>
                </button>

                <button wire:click="applyPrebuiltTheme('emerald')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'emerald' ? 'border-emerald-500 bg-emerald-500/10 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Emerald Forest</span>
                </button>

                <button wire:click="applyPrebuiltTheme('amethyst')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'amethyst' ? 'border-purple-500 bg-purple-500/10 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Cyber Amethyst</span>
                </button>

                <button wire:click="applyPrebuiltTheme('crimson')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'crimson' ? 'border-rose-500 bg-rose-500/10 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Crimson Sunset</span>
                </button>

                <button wire:click="applyPrebuiltTheme('azure')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'azure' ? 'border-sky-500 bg-sky-500/10 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Oceanic Azure</span>
                </button>

                <button wire:click="applyPrebuiltTheme('light')" class="p-2.5 rounded-xl border text-left transition-all cursor-pointer {{ $activeTheme === 'light' ? 'border-indigo-500 bg-slate-200 text-slate-900 font-bold' : 'border-slate-300 dark:border-slate-800' }}">
                    <span class="text-xs skeuo-text-heading block">Light Indigo</span>
                </button>
            </div>

            <!-- Custom @theme Palette Code -->
            <div class="pt-2">
                <label class="block text-xs font-bold skeuo-text-heading mb-1.5">Student Custom @theme Color Palette Code</label>
                <p class="text-[11px] skeuo-text-subtext mb-2">Paste a @theme block with 50-950 shades. Supports: Hex, OKLCH, HSL, RGB</p>
                <textarea wire:model.live.debounce.500ms="customCss" rows="5" class="skeuo-glass-input w-full rounded-xl px-4 py-3 text-xs font-mono" placeholder="@theme {
  --color-gold-50: #fff5e9;
  --color-gold-500: oklch(0.65 0.15 80);
  --color-gold-950: hsl(30, 90%, 5%);
}"></textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button wire:click="saveStudentTheme" class="skeuo-glass-btn-primary px-6 py-2.5 text-xs flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Student Theme</span>
                </button>
            </div>
        </div>

        <!-- Filter & Search Controls (Tactile Inset Glass Wells) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold skeuo-text-heading mb-1">Search Candidates</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name, CNIC, email, mobile..." class="skeuo-glass-input w-full rounded-xl px-4 py-2.5 text-xs">
            </div>
            <div>
                <label class="block text-xs font-bold skeuo-text-heading mb-1">Application Review Status</label>
                <select wire:model.live="statusFilter" class="skeuo-glass-input w-full rounded-xl px-4 py-2.5 text-xs">
                    <option value="">All Review Statuses</option>
                    <option value="1">Approved</option>
                    <option value="2">Pending</option>
                    <option value="3">Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold skeuo-text-heading mb-1">Fee Payment Status</label>
                <select wire:model.live="paymentFilter" class="skeuo-glass-input w-full rounded-xl px-4 py-2.5 text-xs">
                    <option value="">All Payment Statuses</option>
                    <option value="1">Fee Paid & Verified</option>
                    <option value="0">Unpaid / Pending</option>
                </select>
            </div>
        </div>

        <!-- Table of Candidates (Skeuo-Glass Table) -->
        <div class="skeuo-glass-card skeuo-glass-table-container p-0 overflow-x-auto shadow-xl">
            <table class="w-full text-left text-xs">
                <thead class="skeuo-glass-table-head">
                    <tr>
                        <th class="p-3.5">App #</th>
                        <th class="p-3.5">Candidate Name</th>
                        <th class="p-3.5">CNIC / Passport</th>
                        <th class="p-3.5">Mobile</th>
                        <th class="p-3.5">Submitted At</th>
                        <th class="p-3.5">Fee Status</th>
                        <th class="p-3.5">Review Status</th>
                        <th class="p-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300/30 dark:divide-slate-800/60">
                    @forelse($applicants as $app)
                        <tr class="skeuo-glass-row transition-colors">
                            <td class="p-3.5 font-mono font-bold skeuo-text-heading">#{{ $app->id }}</td>
                            <td class="p-3.5 font-bold skeuo-text-heading">{{ $app->name }}</td>
                            <td class="p-3.5 skeuo-text-subtext">{{ $app->cnic_passport ?? 'N/A' }}</td>
                            <td class="p-3.5 skeuo-text-subtext">{{ $app->mobile_number ?? 'N/A' }}</td>
                            <td class="p-3.5 skeuo-text-subtext">{{ $app->submitted_at?->format('d M Y') }}</td>
                            <td class="p-3.5">
                                <button wire:click="togglePayment({{ $app->id }})" title="Click to toggle payment status" class="focus:outline-none cursor-pointer">
                                    @if($app->is_paid)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold skeuo-badge-success">PAID &check;</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold skeuo-badge-warning">UNPAID</span>
                                    @endif
                                </button>
                            </td>
                            <td class="p-3.5">
                                @if($app->status == 1)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold skeuo-badge-success">APPROVED</span>
                                @elseif($app->status == 2)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold skeuo-badge-warning">PENDING</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold skeuo-badge-danger">REJECTED</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right">
                                <button wire:click="selectUser({{ $app->id }})" class="skeuo-glass-btn-secondary px-3 py-1.5 text-xs font-bold">
                                    Review Details
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center skeuo-text-subtext">No applicants found matching the search criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">{{ $applicants->links() }}</div>

        <!-- Selected Candidate Review Drawer/Panel -->
        @if($selectedUser)
            <div class="skeuo-glass-card p-6 space-y-6 shadow-2xl border-indigo-500/30">
                <div class="flex items-center justify-between border-b border-slate-300/40 dark:border-slate-800 pb-3">
                    <h3 class="font-bold skeuo-text-heading text-base flex items-center gap-2">
                        <span>📋 Reviewing Application: {{ $selectedUser->name }} (#{{ $selectedUser->id }})</span>
                    </h3>
                    <button wire:click="$set('selectedUserId', null)" class="skeuo-glass-btn-secondary px-2.5 py-1 text-xs">Close Panel &times;</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <div class="skeuo-glass-card p-4 space-y-2">
                        <h4 class="font-bold text-indigo-600 dark:text-indigo-400 border-b border-slate-300/40 dark:border-slate-800 pb-2">Personal Details</h4>
                        <div><span class="skeuo-text-subtext">Father's Name:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->father_name ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">Mother's Name:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->personalDetails?->mother_name ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">CNIC / Passport:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->cnic_passport ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">Date of Birth:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->personalDetails?->date_of_birth ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">Mobile Number:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->mobile_number ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">Email:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->email }}</strong></div>
                        <div><span class="skeuo-text-subtext">PMDC/PNMC No:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->pmdc_pnmc ?? 'N/A' }}</strong></div>
                    </div>

                    <div class="skeuo-glass-card p-4 space-y-2">
                        <h4 class="font-bold text-indigo-600 dark:text-indigo-400 border-b border-slate-300/40 dark:border-slate-800 pb-2">Academic Qualifications & Entry Test</h4>
                        <div><span class="skeuo-text-subtext">SSC Marks:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->qualifications?->ssc_marks_obtained ?? 'N/A' }} / {{ $selectedUser->qualifications?->ssc_total_marks ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">HSSC Marks:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->qualifications?->hssc_marks_obtained ?? 'N/A' }} / {{ $selectedUser->qualifications?->hssc_total_marks ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">Bachelor Marks:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->qualifications?->mbbs_marks_obtained ?? 'N/A' }} / {{ $selectedUser->qualifications?->mbbs_total_marks ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">M.Phil Marks:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->qualifications?->mphil_marks_obtained ?? 'N/A' }} / {{ $selectedUser->qualifications?->mphil_total_marks ?? 'N/A' }}</strong></div>
                        <div><span class="skeuo-text-subtext">MDCAT Marks:</span> <strong class="skeuo-text-heading ml-1">{{ $selectedUser->admissionTest?->md_cat_obtained_marks ?? 'N/A' }}</strong></div>
                    </div>
                </div>

                <div class="skeuo-glass-card p-4 space-y-3">
                    <h4 class="font-bold text-indigo-600 dark:text-indigo-400 border-b border-slate-300/40 dark:border-slate-800 pb-2 text-xs">Seat Categories & Subjects Selected</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($selectedUser->seatCategories as $cat)
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold skeuo-badge-success">{{ $cat->name }}</span>
                        @endforeach
                        @foreach($selectedUser->mphillPhdSubjects as $sub)
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold skeuo-badge-warning">{{ $sub->subject }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="skeuo-glass-card p-5 space-y-4 border-emerald-500/30">
                    <h4 class="font-bold skeuo-text-heading text-xs uppercase tracking-wider">Official Status Action & Remarks</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold skeuo-text-heading mb-1">Application Review Status</label>
                            <select wire:model="updateStatus" class="skeuo-glass-input w-full rounded-xl px-4 py-2 text-xs">
                                <option value="1">Approve Application</option>
                                <option value="2">Mark Pending / Under Review</option>
                                <option value="3">Reject Application</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold skeuo-text-heading mb-1">Challan Payment Verification</label>
                            <select wire:model="updatePaid" class="skeuo-glass-input w-full rounded-xl px-4 py-2 text-xs">
                                <option value="1">Mark Fee PAID & Verified</option>
                                <option value="0">Mark Fee UNPAID / Pending</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold skeuo-text-heading mb-1">Verification Remarks / Comments</label>
                            <input type="text" wire:model="comments" placeholder="e.g. Verified clean by Admin" class="skeuo-glass-input w-full rounded-xl px-4 py-2 text-xs">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button wire:click="saveUserStatus" class="skeuo-glass-btn-emerald px-6 py-2 text-xs flex items-center space-x-2">
                            <span>Save Review Changes &check;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
