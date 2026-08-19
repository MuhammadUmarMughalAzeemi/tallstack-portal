@php
    $setting = \App\Models\PortalSetting::current();
    $activeTheme = $setting->active_theme ?? 'sapphire';

    $themePresets = [
        'sapphire' => [
            'primary' => '#6366f1',
            'accent' => '#a855f7',
            'bg_canvas' => '#0b0f19',
            'bg_surface' => '#0f172a',
            'bg_elevated' => '#020617',
            'border' => '#1e293b',
            'text_main' => '#f8fafc',
            'text_muted' => '#94a3b8',
        ],
        'emerald' => [
            'primary' => '#10b981',
            'accent' => '#14b8a6',
            'bg_canvas' => '#041410',
            'bg_surface' => '#06241c',
            'bg_elevated' => '#02100c',
            'border' => '#0b3b2f',
            'text_main' => '#ecfdf5',
            'text_muted' => '#6ee7b7',
        ],
        'amethyst' => [
            'primary' => '#a855f7',
            'accent' => '#d946ef',
            'bg_canvas' => '#12071f',
            'bg_surface' => '#1b0b2e',
            'bg_elevated' => '#0d0517',
            'border' => '#2e104d',
            'text_main' => '#faf5ff',
            'text_muted' => '#c084fc',
        ],
        'crimson' => [
            'primary' => '#f43f5e',
            'accent' => '#f59e0b',
            'bg_canvas' => '#1a090d',
            'bg_surface' => '#260d13',
            'bg_elevated' => '#120508',
            'border' => '#42141e',
            'text_main' => '#fff1f2',
            'text_muted' => '#fda4af',
        ],
        'azure' => [
            'primary' => '#0ea5e9',
            'accent' => '#06b6d4',
            'bg_canvas' => '#081426',
            'bg_surface' => '#0d1f3a',
            'bg_elevated' => '#040b17',
            'border' => '#15335e',
            'text_main' => '#f0f9ff',
            'text_muted' => '#38bdf8',
        ],
        'monochrome' => [
            'primary' => '#fafafa',
            'accent' => '#71717a',
            'bg_canvas' => '#09090b',
            'bg_surface' => '#18181b',
            'bg_elevated' => '#27272a',
            'border' => '#3f3f46',
            'text_main' => '#ffffff',
            'text_muted' => '#a1a1aa',
        ],
        'light' => [
            'primary' => '#4f46e5',
            'accent' => '#7c3aed',
            'bg_canvas' => '#f8fafc',
            'bg_surface' => '#ffffff',
            'bg_elevated' => '#f1f5f9',
            'border' => '#e2e8f0',
            'text_main' => '#0f172a',
            'text_muted' => '#64748b',
        ],
        'light-mint' => [
            'primary' => '#059669',
            'accent' => '#0d9488',
            'bg_canvas' => '#f8fafc',
            'bg_surface' => '#ffffff',
            'bg_elevated' => '#f1f5f9',
            'border' => '#e2e8f0',
            'text_main' => '#064e3b',
            'text_muted' => '#047857',
        ],
        'light-rose' => [
            'primary' => '#e11d48',
            'accent' => '#d97706',
            'bg_canvas' => '#f8fafc',
            'bg_surface' => '#ffffff',
            'bg_elevated' => '#f1f5f9',
            'border' => '#e2e8f0',
            'text_main' => '#4c0519',
            'text_muted' => '#be123c',
        ],
        'light-azure' => [
            'primary' => '#0284c7',
            'accent' => '#0891b2',
            'bg_canvas' => '#f8fafc',
            'bg_surface' => '#ffffff',
            'bg_elevated' => '#f1f5f9',
            'border' => '#e2e8f0',
            'text_main' => '#0c4a6e',
            'text_muted' => '#0369a1',
        ],
    ];

    $config = $themePresets[$activeTheme] ?? [
        'primary' => '#6366f1',
        'accent' => '#a855f7',
        'bg_canvas' => '#0b0f19',
        'bg_surface' => '#0f172a',
        'bg_elevated' => '#020617',
        'border' => '#1e293b',
        'text_main' => '#f8fafc',
        'text_muted' => '#94a3b8',
    ];

    // Helper functions for Dynamic Palette Generation (50 -> 950)
    if (!function_exists('portal_hex_to_rgb')) {
        function portal_hex_to_rgb($hex) {
            $hex = ltrim($hex, '#');
            if (strlen($hex) == 3) {
                $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
            }
            return [
                hexdec(substr($hex, 0, 2)),
                hexdec(substr($hex, 2, 2)),
                hexdec(substr($hex, 4, 2))
            ];
        }

        function portal_mix_white($hex, $ratio) {
            $rgb = portal_hex_to_rgb($hex);
            $r = round($rgb[0] * (1 - $ratio) + 255 * $ratio);
            $g = round($rgb[1] * (1 - $ratio) + 255 * $ratio);
            $b = round($rgb[2] * (1 - $ratio) + 255 * $ratio);
            return sprintf("#%02x%02x%02x", $r, $g, $b);
        }

        function portal_mix_black($hex, $ratio) {
            $rgb = portal_hex_to_rgb($hex);
            $r = round($rgb[0] * (1 - $ratio));
            $g = round($rgb[1] * (1 - $ratio));
            $b = round($rgb[2] * (1 - $ratio));
            return sprintf("#%02x%02x%02x", $r, $g, $b);
        }
    }

    $p = $config['primary'];
    $palette = [
        '50' => portal_mix_white($p, 0.92),
        '100' => portal_mix_white($p, 0.82),
        '200' => portal_mix_white($p, 0.65),
        '300' => portal_mix_white($p, 0.45),
        '400' => portal_mix_white($p, 0.22),
        '500' => $p,
        '600' => portal_mix_black($p, 0.15),
        '700' => portal_mix_black($p, 0.30),
        '800' => portal_mix_black($p, 0.45),
        '900' => portal_mix_black($p, 0.60),
        '950' => portal_mix_black($p, 0.75),
    ];

    // ===== CUSTOM @theme PARSER (Hex, OKLCH, HSL, RGB) =====
    $customCss = $setting->custom_css ?? '';
    $parsedPalettes = [];

    if (!empty($customCss)) {
        $colorValuePattern = '#[0-9a-fA-F]{3,8}|oklch\([^)]+\)|hsl[a]?\([^)]+\)|rgb[a]?\([^)]+\)';
        $fullPattern = '/--(?:color-)?([a-z0-9_-]+?)-(50|100|200|300|400|500|600|700|800|900|950):\s*(' . $colorValuePattern . ')\s*;/i';

        preg_match_all($fullPattern, $customCss, $matches, PREG_SET_ORDER);

        foreach ($matches as $m) {
            $colorName = strtolower($m[1]);
            $shadeKey = $m[2];
            $colorVal = trim($m[3]);
            $parsedPalettes[$colorName][$shadeKey] = $colorVal;
        }
    }

    if (!empty($parsedPalettes)) {
        $groupKeys = array_keys($parsedPalettes);
        $mainGroup = $groupKeys[0];
        $accentGroup = $groupKeys[1] ?? $mainGroup;

        foreach ($parsedPalettes[$mainGroup] as $shade => $val) {
            $palette[$shade] = $val;
        }
        if (isset($parsedPalettes[$mainGroup]['500'])) {
            $config['primary'] = $parsedPalettes[$mainGroup]['500'];
        }
        if (isset($parsedPalettes[$accentGroup]['500'])) {
            $config['accent'] = $parsedPalettes[$accentGroup]['500'];
        } elseif (isset($parsedPalettes[$accentGroup]['300'])) {
            $config['accent'] = $parsedPalettes[$accentGroup]['300'];
        }
    }

    $defaultIsLight = str_contains($activeTheme, 'light');
@endphp

<style id="global-portal-theme-styles">
    :root {
        --color-primary-50: {{ $palette['50'] }};
        --color-primary-100: {{ $palette['100'] }};
        --color-primary-200: {{ $palette['200'] }};
        --color-primary-300: {{ $palette['300'] }};
        --color-primary-400: {{ $palette['400'] }};
        --color-primary-500: {{ $palette['500'] }};
        --color-primary-600: {{ $palette['600'] }};
        --color-primary-700: {{ $palette['700'] }};
        --color-primary-800: {{ $palette['800'] }};
        --color-primary-900: {{ $palette['900'] }};
        --color-primary-950: {{ $palette['950'] }};

        --theme-primary: {{ $config['primary'] }};
        --theme-accent: {{ $config['accent'] }};
    }

    /* Primary Accent Buttons & Badges across whole portal */
    button[type="submit"],
    button.bg-primary-600,
    button.bg-indigo-600,
    button.bg-indigo-500,
    span.bg-indigo-600,
    a.bg-indigo-600,
    .bg-indigo-600.btn,
    .btn-primary {
        background-color: {{ $palette['600'] }} !important;
        border-color: {{ $palette['600'] }} !important;
        color: #ffffff !important;
    }
    button[type="submit"] *,
    button.bg-primary-600 *,
    button.bg-indigo-600 *,
    span.bg-indigo-600 * {
        color: #ffffff !important;
    }
    button[type="submit"]:hover,
    button.bg-primary-600:hover,
    button.bg-indigo-600:hover,
    button.bg-indigo-500:hover,
    span.bg-indigo-600:hover,
    a.bg-indigo-600:hover,
    .btn-primary:hover {
        background-color: {{ $palette['700'] }} !important;
        border-color: {{ $palette['700'] }} !important;
        color: #ffffff !important;
    }
    .text-indigo-400, .text-indigo-500, .text-indigo-600 {
        color: {{ $palette['600'] }} !important;
    }

    /* Checkboxes and Radio Buttons - Crisp Tick (✓) & Dot (•) Guarantee */
    input[type="checkbox"],
    input[type="radio"] {
        accent-color: {{ $palette['600'] }} !important;
        width: 1.15rem !important;
        height: 1.15rem !important;
        cursor: pointer !important;
        vertical-align: middle !important;
    }

    /* ============================================================ */
    /* 🎯 UNIVERSAL INTERACTIVE CURSORS & HOVER ENGINE              */
    /* ============================================================ */
    /* 1. All Clickable Elements -> Instant Hand Pointer (👆) */
    button:not(:disabled),
    a[href],
    label:not([disabled]),
    select:not(:disabled),
    summary,
    [wire\:click]:not(:disabled):not([disabled]),
    [role="button"]:not(:disabled):not([disabled]),
    [onclick]:not(:disabled):not([disabled]),
    [tabindex="0"],
    .cursor-pointer,
    input[type="submit"]:not(:disabled),
    input[type="button"]:not(:disabled),
    input[type="reset"]:not(:disabled),
    input[type="checkbox"]:not(:disabled),
    input[type="radio"]:not(:disabled),
    input[type="file"]:not(:disabled),
    [data-upload-field],
    [data-option-card],
    [x-on\:click] {
        cursor: pointer !important;
    }

    /* 2. Drag & Reorder Handles -> Grab Hand (✋) */
    .drag-handle,
    [data-sortable-handle],
    [x-sortable] [data-id] {
        cursor: grab !important;
    }
    .drag-handle:active,
    [data-sortable-handle]:active,
    [x-sortable] [data-id]:active {
        cursor: grabbing !important;
    }

    /* 3. Text Inputs & Editable Areas -> I-Beam Text Cursor (I) */
    input:not([type="checkbox"]):not([type="radio"]):not([type="button"]):not([type="submit"]):not([type="file"]):not([type="color"]):not(:disabled),
    textarea:not(:disabled) {
        cursor: text !important;
    }

    /* 4. Disabled & Blocked Elements -> Prohibited Sign (🚫) */
    button:disabled,
    button[disabled],
    [disabled],
    .disabled,
    input:disabled,
    select:disabled,
    textarea:disabled,
    [aria-disabled="true"],
    .cursor-not-allowed {
        cursor: not-allowed !important;
        pointer-events: auto !important;
    }

    /* 5. Interactive subtle scale/feel for primary buttons */
    button:not(:disabled):active,
    a[href]:active {
        transform: scale(0.985);
        transition: transform 0.1s ease;
    }

    /* ============================================================ */
    /* ☀️ LIGHT MODE RULES (Applies when data-user-mode="light" OR default light theme) */
    /* ============================================================ */
    [data-user-mode="light"],
    [data-user-mode="light"] body,
    [data-user-mode="light"] main,
    [data-user-mode="light"] .page-wrapper,
    [data-user-mode="light"] [class*="min-h-screen"] {
        background-color: #f8fafc !important;
        color: #0f172a !important;
    }

    /* Form Container & Main Card */
    [data-user-mode="light"] .bg-slate-900,
    [data-user-mode="light"] .bg-slate-950,
    [data-user-mode="light"] [class*="bg-slate-900"],
    [data-user-mode="light"] [class*="bg-slate-950"] {
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
        color: #0f172a !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.04) !important;
    }

    /* Sidebar & Container (Light Mode) */
    [data-user-mode="light"] .bg-slate-900\/60,
    [data-user-mode="light"] .bg-slate-800:not(button):not(span.bg-indigo-600),
    [data-user-mode="light"] [class*="bg-slate-800"]:not(button):not(span.bg-indigo-600),
    [data-user-mode="light"] aside {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        color: #1e293b !important;
    }

    /* 3D Floating Glassmorphic Navigation Cards (Light Mode) */
    [data-user-mode="light"] aside nav button:not([class*="translate-x-1"]) {
        background-color: #ffffff;
        border-color: #e2e8f0;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
    }
    [data-user-mode="light"] aside nav button:not([class*="translate-x-1"]):hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07);
    }
    [data-user-mode="light"] aside nav button p.text-xs {
        color: #0f172a !important;
        font-weight: 700 !important;
    }
    [data-user-mode="light"] aside nav button[class*="translate-x-1"] {
        background: linear-gradient(135deg, {{ $palette['50'] }} 0%, #ffffff 55%, #fdf4ff 100%) !important;
        border-color: {{ $palette['300'] }} !important;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.15), 0 4px 6px -4px rgba(99, 102, 241, 0.1) !important;
    }
    [data-user-mode="light"] aside nav button[class*="translate-x-1"] p.text-xs {
        color: {{ $palette['950'] }} !important;
        font-weight: 900 !important;
    }

    /* Selected Option Cards (e.g. PhD, active step card) — ONLY cards, NOT buttons */
    [data-user-mode="light"] div[class*="bg-indigo-500"]:not(button):not(span),
    [data-user-mode="light"] div[class*="bg-indigo-600"]:not(button):not(span),
    [data-user-mode="light"] label[class*="bg-indigo-500"]:not(button),
    [data-user-mode="light"] label[class*="bg-indigo-600"]:not(button) {
        background-color: {{ $palette['100'] }} !important;
        border-color: {{ $palette['500'] }} !important;
        color: {{ $palette['800'] }} !important;
        font-weight: 700 !important;
    }

    /* Light Mode Primary Action Buttons — ALWAYS 100% Solid Primary Background & White Text */
    [data-user-mode="light"] button[type="submit"],
    [data-user-mode="light"] button.bg-indigo-600,
    [data-user-mode="light"] button.bg-indigo-500,
    [data-user-mode="light"] button.bg-primary-600,
    [data-user-mode="light"] span.bg-indigo-600,
    [data-user-mode="light"] a.bg-indigo-600,
    [data-user-mode="light"] .btn-primary {
        background-color: {{ $palette['600'] }} !important;
        border-color: {{ $palette['600'] }} !important;
        color: #ffffff !important;
    }
    [data-user-mode="light"] button[type="submit"] *,
    [data-user-mode="light"] button.bg-indigo-600 *,
    [data-user-mode="light"] button.bg-indigo-500 *,
    [data-user-mode="light"] button.bg-primary-600 *,
    [data-user-mode="light"] span.bg-indigo-600 * {
        color: #ffffff !important;
    }
    [data-user-mode="light"] button[type="submit"]:hover,
    [data-user-mode="light"] button.bg-indigo-600:hover,
    [data-user-mode="light"] button.bg-indigo-500:hover,
    [data-user-mode="light"] button.bg-primary-600:hover,
    [data-user-mode="light"] span.bg-indigo-600:hover,
    [data-user-mode="light"] a.bg-indigo-600:hover,
    [data-user-mode="light"] .btn-primary:hover {
        background-color: {{ $palette['700'] }} !important;
        border-color: {{ $palette['700'] }} !important;
        color: #ffffff !important;
    }

    /* Inputs, Selects, and Textareas */
    [data-user-mode="light"] input:not([type="checkbox"]):not([type="radio"]):not([type="color"]),
    [data-user-mode="light"] select,
    [data-user-mode="light"] textarea {
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
        color: #0f172a !important;
    }
    [data-user-mode="light"] input::placeholder,
    [data-user-mode="light"] textarea::placeholder {
        color: #94a3b8 !important;
    }
    [data-user-mode="light"] input:focus,
    [data-user-mode="light"] select:focus,
    [data-user-mode="light"] textarea:focus {
        border-color: {{ $palette['500'] }} !important;
        box-shadow: 0 0 0 3px {{ $palette['100'] }} !important;
    }

    /* Unchecked Checkbox & Radio in Light Mode */
    [data-user-mode="light"] input[type="checkbox"]:not(:checked),
    [data-user-mode="light"] input[type="radio"]:not(:checked) {
        background-color: #ffffff !important;
        border-color: #94a3b8 !important;
    }

    /* Borders */
    [data-user-mode="light"] .border-slate-800,
    [data-user-mode="light"] .border-slate-700,
    [data-user-mode="light"] [class*="border-slate-800"] {
        border-color: #e2e8f0 !important;
    }

    /* Typography & Contrast Guarantee for Light Mode */
    [data-user-mode="light"] h1,
    [data-user-mode="light"] h2,
    [data-user-mode="light"] h3,
    [data-user-mode="light"] h4,
    [data-user-mode="light"] h5,
    [data-user-mode="light"] h6,
    [data-user-mode="light"] label,
    [data-user-mode="light"] span:not(.text-white):not(.bg-indigo-600):not(.bg-emerald-600):not(button *):not(a.bg-indigo-600 *),
    [data-user-mode="light"] p:not(button *):not(a.bg-indigo-600 *),
    [data-user-mode="light"] [class*="text-slate-100"]:not(button *):not(a.bg-indigo-600 *),
    [data-user-mode="light"] [class*="text-slate-200"]:not(button *):not(a.bg-indigo-600 *),
    [data-user-mode="light"] [class*="text-slate-300"]:not(button *):not(a.bg-indigo-600 *) {
        color: #0f172a !important;
    }
    [data-user-mode="light"] [class*="text-slate-400"]:not(button *):not(a.bg-indigo-600 *),
    [data-user-mode="light"] [class*="text-slate-500"]:not(button *):not(a.bg-indigo-600 *) {
        color: #475569 !important;
    }

    /* Primary action buttons — STRICT white text/icons guarantee across ALL themes */
    button[type="submit"],
    button[type="submit"] *,
    button.bg-primary-600,
    button.bg-primary-600 *,
    button.bg-indigo-600,
    button.bg-indigo-600 *,
    button.bg-indigo-500,
    button.bg-indigo-500 *,
    a.bg-indigo-600,
    a.bg-indigo-600 *,
    span.bg-indigo-600,
    span.bg-indigo-600 *,
    .btn-primary,
    .btn-primary * {
        color: #ffffff !important;
    }

    [data-user-mode="light"] button[type="submit"],
    [data-user-mode="light"] button[type="submit"] *,
    [data-user-mode="light"] button.bg-primary-600,
    [data-user-mode="light"] button.bg-primary-600 *,
    [data-user-mode="light"] button.bg-indigo-600,
    [data-user-mode="light"] button.bg-indigo-600 *,
    [data-user-mode="light"] button.bg-indigo-500,
    [data-user-mode="light"] button.bg-indigo-500 *,
    [data-user-mode="light"] a.bg-indigo-600,
    [data-user-mode="light"] a.bg-indigo-600 *,
    [data-user-mode="light"] span.bg-indigo-600,
    [data-user-mode="light"] span.bg-indigo-600 *,
    [data-user-mode="light"] button.text-white,
    [data-user-mode="light"] button.text-white *,
    [data-user-mode="light"] .btn-primary,
    [data-user-mode="light"] .btn-primary * {
        color: #ffffff !important;
    }

    /* ============================================================ */
    /* 🌙 DARK MODE RULES (Applies when data-user-mode="dark" OR default dark theme) */
    /* ============================================================ */
    [data-user-mode="dark"],
    [data-user-mode="dark"] body,
    [data-user-mode="dark"] main,
    [data-user-mode="dark"] .page-wrapper,
    [data-user-mode="dark"] [class*="min-h-screen"] {
        background-color: #0b0f19 !important;
        color: #f8fafc !important;
    }

    [data-user-mode="dark"] .bg-slate-900,
    [data-user-mode="dark"] [class*="bg-slate-900"] {
        background-color: #0f172a !important;
        border-color: #1e293b !important;
        color: #f8fafc !important;
    }

    [data-user-mode="dark"] .bg-slate-950,
    [data-user-mode="dark"] [class*="bg-slate-950"],
    [data-user-mode="dark"] .bg-slate-800,
    [data-user-mode="dark"] [class*="bg-slate-800"],
    [data-user-mode="dark"] aside {
        background-color: #020617 !important;
        border-color: #1e293b !important;
        color: #f8fafc !important;
    }

    [data-user-mode="dark"] input:not([type="checkbox"]):not([type="radio"]):not([type="color"]),
    [data-user-mode="dark"] select,
    [data-user-mode="dark"] textarea {
        background-color: #020617 !important;
        border-color: #1e293b !important;
        color: #f8fafc !important;
    }

    /* Unchecked Checkbox & Radio in Dark Mode */
    [data-user-mode="dark"] input[type="checkbox"]:not(:checked),
    [data-user-mode="dark"] input[type="radio"]:not(:checked) {
        background-color: #020617 !important;
        border-color: #475569 !important;
    }

    [data-user-mode="dark"] h1,
    [data-user-mode="dark"] h2,
    [data-user-mode="dark"] h3,
    [data-user-mode="dark"] h4,
    [data-user-mode="dark"] h5,
    [data-user-mode="dark"] h6,
    [data-user-mode="dark"] label,
    [data-user-mode="dark"] [class*="text-slate-100"],
    [data-user-mode="dark"] [class*="text-slate-200"],
    [data-user-mode="dark"] [class*="text-slate-300"] {
        color: #f8fafc !important;
    }

    /* Checked State Styling for both Light and Dark mode */
    input[type="checkbox"]:checked,
    input[type="radio"]:checked {
        background-color: {{ $palette['600'] }} !important;
        border-color: {{ $palette['600'] }} !important;
    }

    /* Document upload — primary buttons & progress (theme-aware) */
    .bg-primary-600 {
        background-color: {{ $palette['600'] }} !important;
        color: #ffffff !important;
    }
    .bg-primary-600:hover,
    .hover\:bg-primary-700:hover {
        background-color: {{ $palette['700'] }} !important;
    }
    .bg-primary-600 .h-full,
    .bg-primary-600.transition-all {
        background-color: {{ $palette['600'] }} !important;
    }

    /* Custom CSS Overrides defined in PortalSetting */
    {{ $setting->custom_css ?? '' }}
</style>

<!-- ============================================================ -->
<!-- 🛑 FORM VALIDATION ERRORS — ALWAYS RED (immune to any theme)   -->
<!-- Loads AFTER the theme palette so it wins every cascade battle. -->
<!-- ============================================================ -->
<style id="global-portal-validation-error-styles">
    /* Error message text — every mode, every theme, every palette */
    html[data-user-mode] span.text-rose-400,
    html[data-user-mode] span.text-rose-500,
    html[data-user-mode] span.text-red-500,
    html[data-user-mode] span.text-red-600,
    html[data-user-mode] p.text-rose-400,
    html[data-user-mode] p.text-rose-300,
    html[data-user-mode] li.text-rose-300,
    html[data-user-mode] .text-rose-400,
    html[data-user-mode] .text-rose-500,
    html[data-user-mode] .text-red-500,
    html[data-user-mode] .text-red-600 {
        color: rgb(251 113 133) !important;
    }

    /* Red borders on invalid inputs/selects/textareas */
    html[data-user-mode] input:not([type="checkbox"]):not([type="radio"]):not([type="color"]).border-rose-500,
    html[data-user-mode] select.border-rose-500,
    html[data-user-mode] textarea.border-rose-500,
    html[data-user-mode] input[class*="border-rose-500"].border-rose-500 {
        border-color: rgb(244 63 94) !important;
    }

    /* Keep the red border while the invalid field is focused */
    html[data-user-mode] input.border-rose-500:focus,
    html[data-user-mode] select.border-rose-500:focus,
    html[data-user-mode] textarea.border-rose-500:focus {
        border-color: rgb(251 113 133) !important;
        box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.15) !important;
    }
</style>
