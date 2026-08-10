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
    <div class="min-h-screen">
        {{ $slot }}
    </div>

@livewireScripts
</body>
</html>
