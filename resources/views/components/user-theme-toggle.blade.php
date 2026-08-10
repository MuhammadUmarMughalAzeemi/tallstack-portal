@php
    $setting = \App\Models\PortalSetting::current();
    $defaultIsLight = str_contains($setting->active_theme ?? 'sapphire', 'light');
    $defaultMode = $defaultIsLight ? 'light' : 'dark';
@endphp

<div x-data="{
        mode: localStorage.getItem('portal_user_mode') || '{{ $defaultMode }}',
        toggle() {
            this.mode = this.mode === 'light' ? 'dark' : 'light';
            localStorage.setItem('portal_user_mode', this.mode);
            document.documentElement.setAttribute('data-user-mode', this.mode);
            this.$dispatch('user-mode-changed', this.mode);
        },
        init() {
            const savedMode = localStorage.getItem('portal_user_mode');
            const activeMode = savedMode || '{{ $defaultMode }}';
            document.documentElement.setAttribute('data-user-mode', activeMode);
        }
    }"
    x-init="init()"
    class="inline-flex items-center">

    <button @click="toggle()"
            type="button"
            title="Toggle Light / Dark Mode"
            class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl border transition-all duration-300 text-xs font-semibold shadow-sm focus:outline-none cursor-pointer"
            :class="mode === 'light'
                ? 'bg-white border-slate-300 text-slate-800 hover:bg-slate-50 shadow-slate-200/50'
                : 'bg-slate-900 border-slate-800 text-slate-100 hover:bg-slate-850 shadow-black/50'">

        <!-- Sun Icon (Active in Dark Mode to switch to Light) -->
        <template x-if="mode === 'dark'">
            <div class="flex items-center gap-1.5 text-amber-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="font-bold">Light Mode</span>
            </div>
        </template>

        <!-- Moon Icon (Active in Light Mode to switch to Dark) -->
        <template x-if="mode === 'light'">
            <div class="flex items-center gap-1.5 text-indigo-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <span class="font-bold">Dark Mode</span>
            </div>
        </template>
    </button>
</div>
