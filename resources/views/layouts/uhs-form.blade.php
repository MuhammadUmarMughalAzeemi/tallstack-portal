<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Post Graduate Admission Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script>
        (function() {
            const savedMode = localStorage.getItem('portal_user_mode');
            const defaultMode = '{{ str_contains(\App\Models\PortalSetting::current()->active_theme ?? 'sapphire', 'light') ? 'light' : 'dark' }}';
            document.documentElement.setAttribute('data-user-mode', savedMode || defaultMode);
        })();
    </script>

    <!-- Dynamic Universal Portal Theme Engine -->
    <x-global-theme-styles />
</head>
<body class="font-sans antialiased" data-theme="{{ \App\Models\PortalSetting::current()->active_theme ?? 'sapphire' }}">
    <x-toast />
    <x-dialog />

    <!-- Document Preview Modal -->
    <div id="docPreviewModal"
         class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
         onclick="if(event.target===this) window.closeDocModal()">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
        <!-- Modal box -->
        <div class="relative z-10 bg-white rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
                <p id="docPreviewLabel" class="text-sm font-bold text-gray-700 truncate"></p>
                <button onclick="window.closeDocModal()"
                        class="w-8 h-8 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Image -->
            <div class="p-4 bg-gray-50 flex items-center justify-center min-h-64 max-h-[70vh] overflow-auto">
                <img id="docPreviewImg" src="" alt="" class="max-w-full max-h-[65vh] object-contain rounded-lg shadow-md">
            </div>
            <!-- Footer -->
            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100 bg-white">
                <span class="text-xs text-gray-400">Click outside to close</span>
                <a id="docPreviewDownload" href="#" download
                   class="text-xs font-bold text-teal-600 hover:text-teal-700 flex items-center gap-1 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
            </div>
        </div>
    </div>

    <div class="min-h-screen">
        {{ $slot }}
    </div>

@livewireScripts

<script>
    window.openDocModal = function(url, label) {
        const modal   = document.getElementById('docPreviewModal');
        const img     = document.getElementById('docPreviewImg');
        const lbl     = document.getElementById('docPreviewLabel');
        const dl      = document.getElementById('docPreviewDownload');

        img.src       = url;
        img.alt       = label || 'Document';
        lbl.textContent = label || 'Document Preview';
        dl.href       = url;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeDocModal = function() {
        const modal = document.getElementById('docPreviewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        // Clear src after transition to avoid flash
        setTimeout(() => { document.getElementById('docPreviewImg').src = ''; }, 150);
    };

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') window.closeDocModal();
    });
</script>
</body>
</html>
