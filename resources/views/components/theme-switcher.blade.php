<div x-data="{ open: false }" class="relative inline-block text-left z-50">
    <button @click="open = !open" type="button" class="px-3 py-1.5 bg-slate-800/90 hover:bg-slate-800 border border-slate-700/80 rounded-xl text-xs font-semibold text-slate-200 transition-all flex items-center space-x-2 shadow-lg">
        <span class="w-3 h-3 rounded-full shadow-sm" :class="{
            'bg-indigo-500': $store.portalTheme.theme === 'sapphire',
            'bg-emerald-500': $store.portalTheme.theme === 'emerald',
            'bg-purple-500': $store.portalTheme.theme === 'amethyst',
            'bg-rose-500': $store.portalTheme.theme === 'crimson',
            'bg-sky-500': $store.portalTheme.theme === 'azure',
            'bg-slate-200': $store.portalTheme.theme === 'light'
        }"></span>
        <span class="uppercase tracking-wider text-[11px] font-bold" x-text="$store.portalTheme.theme"></span>
        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" class="absolute right-0 mt-2 w-48 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl p-2 space-y-1 text-xs">
        <div class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-800 mb-1">Select Theme Palette</div>
        
        <button @click="$store.portalTheme.setTheme('sapphire'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-indigo-400': $store.portalTheme.theme === 'sapphire' }">
            <span class="w-3.5 h-3.5 rounded-full bg-indigo-500 shadow-sm"></span>
            <span class="text-slate-200">Midnight Sapphire</span>
        </button>

        <button @click="$store.portalTheme.setTheme('emerald'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-emerald-400': $store.portalTheme.theme === 'emerald' }">
            <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-sm"></span>
            <span class="text-slate-200">Emerald Forest</span>
        </button>

        <button @click="$store.portalTheme.setTheme('amethyst'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-purple-400': $store.portalTheme.theme === 'amethyst' }">
            <span class="w-3.5 h-3.5 rounded-full bg-purple-500 shadow-sm"></span>
            <span class="text-slate-200">Cyber Amethyst</span>
        </button>

        <button @click="$store.portalTheme.setTheme('crimson'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-rose-400': $store.portalTheme.theme === 'crimson' }">
            <span class="w-3.5 h-3.5 rounded-full bg-rose-500 shadow-sm"></span>
            <span class="text-slate-200">Crimson Sunset</span>
        </button>

        <button @click="$store.portalTheme.setTheme('azure'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-sky-400': $store.portalTheme.theme === 'azure' }">
            <span class="w-3.5 h-3.5 rounded-full bg-sky-500 shadow-sm"></span>
            <span class="text-slate-200">Oceanic Azure</span>
        </button>

        <button @click="$store.portalTheme.setTheme('light'); open = false" class="w-full flex items-center space-x-2.5 p-2 rounded-xl text-left hover:bg-slate-800 transition-all" :class="{ 'bg-slate-800/80 font-bold text-indigo-400': $store.portalTheme.theme === 'light' }">
            <span class="w-3.5 h-3.5 rounded-full bg-slate-200 shadow-sm"></span>
            <span class="text-slate-200">Light Glassmorphic</span>
        </button>
    </div>
</div>
