<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic Universal Portal Theme Engine -->
    <x-global-theme-styles />

    <style>
        /* REMOVED ALL TRANSITIONS - No animations, no transitions, no delays */
        /* FIXED SCROLL ISSUE - Prevent any unwanted scrolling */

        /* Global reset for scrolling - prevent page scroll */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Prevents page scroll completely */
        }

        /* Main container takes full viewport without scroll */
        .min-h-screen {
            min-height: 100vh;
            height: 100vh;
            overflow: hidden; /* No scroll on container */
        }

        /* Ensure no scrollbars appear */
        body {
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }

        /* Main wrapper - no overflow */
        .page-wrapper {
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
        }
        .two-col-layout {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            max-height: 90vh;
            height: auto;
        }

        .login-column {
            height: auto;
            align-self: stretch;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .login-column::-webkit-scrollbar {
            width: 4px;
        }

        .login-column::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .login-column::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }

        .info-column {
            display: flex;
            align-items: stretch;
            overflow: hidden;
        }

        .login-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-content {
            overflow-y: auto;
            scrollbar-width: thin;
            height: 100%;
        }

        .info-content::-webkit-scrollbar {
            width: 4px;
        }

        .info-content::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }

        .info-content::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .two-col-layout {
                flex-direction: column;
                max-height: 90vh;
            }
            .info-column {
                min-height: auto;
                max-height: 50%;
            }
            .login-column {
                max-height: 50%;
            }
        }

        * {
            transition: none !important;
            animation: none !important;
        }

        a, button, input, select, textarea, [class*="transition"], [class*="animate"] {
            transition: none !important;
            animation: none !important;
            transform: none !important;
        }
        .backdrop-blur-sm {
            backdrop-filter: none !important;
        }

        .hover\:scale-105, .hover\:translate-y-1, .transform {
            transform: none !important;
        }

        .rounded-2xl {
            overflow: hidden;
        }

        .bg-cover {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .p-4, .md\:p-6 {
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .md\:p-6 {
                padding: 1.5rem;
            }
        }

        /* ===== Monochrome (B&W) Theme Override for Login Page ===== */
        @php $portalTheme = \App\Models\PortalSetting::current(); @endphp

        @if(($portalTheme->active_theme ?? 'sapphire') === 'monochrome')
        .page-wrapper {
            background-color: #09090b !important;
        }
        .two-col-layout {
            background: #18181b !important;
            border: 1px solid #27272a;
        }
        .login-column {
            background: #18181b !important;
        }
        .login-column .login-inner {
            color: #fafafa;
        }
        .login-column label, .login-column span, .login-column p, .login-column h1, .login-column h2, .login-column h3, .login-column a {
            color: #e4e4e7 !important;
        }
        .login-column input, .login-column select, .login-column textarea {
            background: #27272a !important;
            border-color: #3f3f46 !important;
            color: #fafafa !important;
        }
        .login-column input:focus, .login-column select:focus, .login-column textarea:focus {
            border-color: #a1a1aa !important;
            box-shadow: 0 0 0 2px rgba(161, 161, 170, 0.2) !important;
        }
        .login-column button[type="submit"], .login-column .bg-indigo-600 {
            background: #fafafa !important;
            color: #09090b !important;
            border: 1px solid #d4d4d8;
        }
        .login-column button[type="submit"]:hover, .login-column .bg-indigo-600:hover {
            background: #e4e4e7 !important;
        }
        .login-column .text-indigo-600, .login-column .text-indigo-700 {
            color: #a1a1aa !important;
        }
        .login-column .hover\:text-indigo-800:hover {
            color: #fafafa !important;
        }
        .login-column .bg-indigo-50 {
            background: #27272a !important;
        }
        .login-column .text-gray-600, .login-column .text-gray-700, .login-column .text-gray-900 {
            color: #d4d4d8 !important;
        }
        .login-column .border-gray-300 {
            border-color: #3f3f46 !important;
        }
        .login-column::-webkit-scrollbar-thumb {
            background: #52525b !important;
        }
        .login-column::-webkit-scrollbar-track {
            background: #27272a !important;
        }
        @endif
    </style>
</head>
<body class="font-sans text-gray-900 antialiased" data-theme="{{ $portalTheme->active_theme ?? 'sapphire' }}" style="margin:0; padding:0; overflow:hidden; position:fixed; top:0; left:0; right:0; bottom:0; width:100%; height:100%;">

<div class="page-wrapper">

    <div class="two-col-layout flex flex-col md:flex-row w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden" style="max-height: 90vh; margin: auto;">

        <div class="login-column w-full md:w-1/2 bg-white" style="overflow-y: auto;">
            <div class="login-inner px-6 py-8 sm:px-10 sm:py-12">
                {{ $slot }}
            </div>
        </div>

        <div class="info-column relative w-full md:w-1/2 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('images/bgpic.jpg') }}'); background-size: cover; background-position: center; overflow: hidden;">

            <div class="absolute inset-0 bg-black/60"></div>

            <div class="info-content relative z-10 flex flex-col justify-center h-full px-8 py-12 text-white" style="overflow-y: auto;">
                <!-- Brand icon -->
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center bg-white/20 rounded-2xl p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                </div>

                <!-- Main Heading - No animations -->
                <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                    Welcome to <br>
                    <span class="text-indigo-300">Your Workspace</span>
                </h1>
                <div class="w-20 h-1 bg-indigo-400 my-6 rounded-full"></div>

                <div class="space-y-5">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-5 h-5 rounded-full bg-indigo-500/40 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold">Secure Access</h3>
                            <p class="text-white/70 text-sm">Use your official credentials provided by the system administrator</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-5 h-5 rounded-full bg-indigo-500/40 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold">MFA Enabled</h3>
                            <p class="text-white/70 text-sm">Multi-factor authentication adds an extra layer of security</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-5 h-5 rounded-full bg-indigo-500/40 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold">Strong Password</h3>
                            <p class="text-white/70 text-sm">Minimum 8 characters with uppercase, lowercase & numbers</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-5 h-5 rounded-full bg-indigo-500/40 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636L9.172 14.828m0 0l-3.536-3.536m3.536 3.536L3 16.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold">24/7 Support</h3>
                            <p class="text-white/70 text-sm">Contact helpdesk at <span class="text-indigo-200">support@company.com</span></p>
                        </div>
                    </div>
                </div>

                <!-- Footer Note - No animations or delays -->
                <div class="mt-10 pt-5 text-xs text-white/40 border-t border-white/20">
                    Secure Portal • All activities are monitored
                </div>
            </div>
        </div>
    </div>
</div>

@livewireScripts

<script>
    // Additional fix to ensure no scroll on body
    if (document.body) {
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '0';
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.bottom = '0';
        document.body.style.width = '100%';
        document.body.style.height = '100%';
        document.body.style.margin = '0';
        document.body.style.padding = '0';
    }

    // Ensure html element also has no scroll
    if (document.documentElement) {
        document.documentElement.style.overflow = 'hidden';
        document.documentElement.style.height = '100%';
    }
</script>
</body>
</html>
