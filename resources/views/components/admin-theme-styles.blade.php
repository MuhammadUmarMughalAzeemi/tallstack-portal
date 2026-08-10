@php
    $setting = \App\Models\PortalSetting::current();
    $adminTheme = $setting->admin_theme ?? 'frost-sapphire';

    // 1. Shared Theme Presets (Harmonized 80%+ with Student Portal)
    $presetConfigs = [
        'frost-sapphire' => [
            'primary' => '#6366f1',
            'accent' => '#a855f7',
            'bg_canvas' => '#0b0f19',
            'bg_surface' => '#0f172a',
            'bg_elevated' => '#020617',
            'border' => 'rgba(99, 102, 241, 0.35)',
            'glow' => 'rgba(99, 102, 241, 0.25)',
            'btn_from' => '#6366f1', 'btn_to' => '#4338ca',
            'btn_border' => '#818cf8', 'btn_top' => '#a5b4fc', 'btn_bottom' => '#312e81',
        ],
        'emerald-glass' => [
            'primary' => '#10b981',
            'accent' => '#14b8a6',
            'bg_canvas' => '#041410',
            'bg_surface' => '#06241c',
            'bg_elevated' => '#02100c',
            'border' => 'rgba(16, 185, 129, 0.35)',
            'glow' => 'rgba(16, 185, 129, 0.25)',
            'btn_from' => '#10b981', 'btn_to' => '#047857',
            'btn_border' => '#34d399', 'btn_top' => '#6ee7b7', 'btn_bottom' => '#064e3b',
        ],
        'obsidian-crystal' => [
            'primary' => '#a855f7',
            'accent' => '#d946ef',
            'bg_canvas' => '#12071f',
            'bg_surface' => '#1b0b2e',
            'bg_elevated' => '#0d0517',
            'border' => 'rgba(168, 85, 247, 0.35)',
            'glow' => 'rgba(168, 85, 247, 0.25)',
            'btn_from' => '#a855f7', 'btn_to' => '#7c3aed',
            'btn_border' => '#c084fc', 'btn_top' => '#d8b4fe', 'btn_bottom' => '#4c1d95',
        ],
        'luxe-gold' => [
            'primary' => '#f59e0b',
            'accent' => '#eab308',
            'bg_canvas' => '#1a0f02',
            'bg_surface' => '#261603',
            'bg_elevated' => '#120a01',
            'border' => 'rgba(245, 158, 11, 0.35)',
            'glow' => 'rgba(245, 158, 11, 0.25)',
            'btn_from' => '#f59e0b', 'btn_to' => '#b45309',
            'btn_border' => '#fbbf24', 'btn_top' => '#fde68a', 'btn_bottom' => '#78350f',
        ],
        'rose-quartz' => [
            'primary' => '#f43f5e',
            'accent' => '#ec4899',
            'bg_canvas' => '#1a090d',
            'bg_surface' => '#260d13',
            'bg_elevated' => '#120508',
            'border' => 'rgba(244, 63, 94, 0.35)',
            'glow' => 'rgba(244, 63, 94, 0.25)',
            'btn_from' => '#f43f5e', 'btn_to' => '#be123c',
            'btn_border' => '#fb7185', 'btn_top' => '#fda4af', 'btn_bottom' => '#881337',
        ],
    ];

    if (!function_exists('admin_hex_to_rgb')) {
        function admin_hex_to_rgb($hex) {
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
    }

    if ($adminTheme === 'custom-glass') {
        $customCss = $setting->custom_css ?? '';

        // Smart scale-aware parser: extract --variable-NNN: #hex pairs
        // Picks the correct shade for each UI role instead of blindly
        // grabbing index[0] (which is the near-white 50-shade)
        preg_match_all(
            '/--[\w-]+-(\d+)\s*:\s*(#[a-fA-F0-9]{6}|#[a-fA-F0-9]{3})\b/',
            $customCss, $scaleMatches, PREG_SET_ORDER
        );
        $shadeMap = [];
        foreach ($scaleMatches as $m) {
            $shadeMap[(int) $m[1]] = $m[2];
        }

        // Semantic shade mapping
        $primaryHex = $shadeMap[500] ?? $shadeMap[600] ?? '#a855f7'; // vibrant center
        $accentHex  = $shadeMap[400] ?? $shadeMap[300] ?? $primaryHex; // lighter highlight
        $darkHex    = $shadeMap[700] ?? $shadeMap[800] ?? '#6d28d9';   // deep for btn gradient
        $deepHex    = $shadeMap[950] ?? $shadeMap[900] ?? '#1e0a3c';   // near-black source
        $lightHex   = $shadeMap[300] ?? $shadeMap[200] ?? $accentHex;  // bright border top

        $rgb1    = admin_hex_to_rgb($primaryHex);
        $deepRgb = admin_hex_to_rgb($deepHex);

        // 50% MATCH: blend palette-derived backgrounds 50/50 with neutral admin dark
        // Admin stays in the same COLOR FAMILY as student but half the saturation,
        // giving a professional, calmer look that complements rather than competes.
        $neutralBase   = [8, 12, 22]; // neutral admin dark base (#080c16)
        $bgCanvasRgb   = [
            (int) ($neutralBase[0] * 0.5 + $deepRgb[0] * 0.5),
            (int) ($neutralBase[1] * 0.5 + $deepRgb[1] * 0.5),
            (int) ($neutralBase[2] * 0.5 + $deepRgb[2] * 0.5),
        ];
        $bgSurfaceRgb  = [
            min(255, (int) ($neutralBase[0] * 0.5 + ($deepRgb[0] + 14) * 0.5)),
            min(255, (int) ($neutralBase[1] * 0.5 + ($deepRgb[1] +  9) * 0.5)),
            min(255, (int) ($neutralBase[2] * 0.5 + ($deepRgb[2] +  5) * 0.5)),
        ];
        $bgElevatedRgb = [
            max(0, $bgCanvasRgb[0] - 4),
            max(0, $bgCanvasRgb[1] - 3),
            max(0, $bgCanvasRgb[2] - 2),
        ];

        $activeConfig = [
            'primary'     => $primaryHex,
            'accent'      => $accentHex,
            'bg_canvas'   => sprintf('#%02x%02x%02x', ...$bgCanvasRgb),
            'bg_surface'  => sprintf('#%02x%02x%02x', ...$bgSurfaceRgb),
            'bg_elevated' => sprintf('#%02x%02x%02x', ...$bgElevatedRgb),
            // 50% reduced ambient opacity — admin is calmer, student is vibrant
            'border'      => "rgba({$rgb1[0]}, {$rgb1[1]}, {$rgb1[2]}, 0.20)",
            'glow'        => "rgba({$rgb1[0]}, {$rgb1[1]}, {$rgb1[2]}, 0.12)",
            // Buttons keep FULL palette color — interactive elements stay vibrant
            'btn_from'    => $primaryHex,
            'btn_to'      => $darkHex,
            'btn_border'  => $accentHex,
            'btn_top'     => $lightHex,
            'btn_bottom'  => $shadeMap[800] ?? $darkHex,
            // Ambient background radial gradient: 50% of preset intensities
            '_ambient1'   => '0.11',  // presets use 0.22
            '_ambient2'   => '0.09',  // presets use 0.18
        ];
    } else {
        $activeConfig = $presetConfigs[$adminTheme] ?? $presetConfigs['frost-sapphire'];
    }

    $primaryRgb  = implode(', ', admin_hex_to_rgb($activeConfig['primary']));
    $accentRgb   = implode(', ', admin_hex_to_rgb($activeConfig['accent']));
    $surfaceRgb  = implode(', ', admin_hex_to_rgb($activeConfig['bg_surface']));
    $elevatedRgb = implode(', ', admin_hex_to_rgb($activeConfig['bg_elevated']));
    // Ambient gradient opacities: custom-glass = 50% match; presets = full intensity
    $ambientOp1  = $activeConfig['_ambient1'] ?? '0.22';
    $ambientOp2  = $activeConfig['_ambient2'] ?? '0.18';
@endphp

<style id="admin-skeuo-glass-theme-styles">
    /* ============================================================ */
    /* 💎 UNIVERSAL FILAMENT ADMIN SKEUO-GLASSMORPHISM THEME       */
    /* 80%+ Harmonized with Student Portal Color Schemes           */
    /* ============================================================ */

    :root {
        --skeuo-glass-blur: 20px;
        --skeuo-radius-lg: 1.25rem;
        --skeuo-radius-md: 0.875rem;
        --skeuo-radius-sm: 0.5rem;
        --skeuo-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        --skeuo-accent-rgb: {{ $primaryRgb }};
        --skeuo-accent2-rgb: {{ $accentRgb }};
    }

    /* Transparent Layout Containers so canvas gradient shines through */
    html.fi .fi-layout,
    html.fi .fi-main-ctn,
    html.fi .fi-main,
    html.fi .fi-page {
        background-color: transparent !important;
    }

    /* ============================================================ */
    /* 🌙 DARK MODE (Filament: html.fi.dark - Primary Experience)   */
    /* ============================================================ */

    /* 1. Ambient Canvas Background — 50% match for custom-glass, full for presets */
    html.fi.dark .fi-body {
        background-color: {{ $activeConfig['bg_canvas'] }} !important;
        background-image:
            radial-gradient(at 0% 0%, rgba({{ $primaryRgb }}, {{ $ambientOp1 }}) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba({{ $accentRgb }}, {{ $ambientOp2 }}) 0px, transparent 50%),
            radial-gradient(at 50% 50%, rgba({{ $elevatedRgb }}, 0.7) 0px, transparent 100%) !important;
        color: #f8fafc !important;
    }

    /* 2. Frosted Glass Topbar (Dark) */
    html.fi.dark .fi-topbar,
    html.fi.dark header.fi-topbar {
        background: rgba({{ $surfaceRgb }}, 0.82) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        -webkit-backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border-bottom: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow:
            0 4px 25px {{ $activeConfig['glow'] }},
            inset 0 -1px 1px rgba(255, 255, 255, 0.08) !important;
    }

    /* 3. Frosted Glass Sidebar (Dark) */
    html.fi.dark .fi-sidebar,
    html.fi.dark aside.fi-sidebar {
        background: linear-gradient(180deg, rgba({{ $elevatedRgb }}, 0.92) 0%, rgba({{ $surfaceRgb }}, 0.88) 100%) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        -webkit-backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border-right: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow:
            6px 0 35px {{ $activeConfig['glow'] }},
            inset -1px 0 1px rgba(255, 255, 255, 0.08) !important;
    }

    html.fi.dark .fi-sidebar-header,
    html.fi.dark .fi-sidebar-nav,
    html.fi.dark .fi-sidebar-footer {
        background: transparent !important;
    }

    /* 4. Sidebar Brand / Logo Header (Dark) */
    html.fi.dark .fi-sidebar-header-logo-ctn,
    html.fi.dark .fi-logo,
    html.fi.dark .fi-brand {
        color: {{ $activeConfig['primary'] }} !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        text-shadow: 0 0 16px {{ $activeConfig['glow'] }} !important;
    }

    /* 5. Sidebar Navigation Items (Dark) */
    html.fi.dark .fi-sidebar-item-btn {
        border-radius: var(--skeuo-radius-md) !important;
        transition: var(--skeuo-transition) !important;
        margin: 3px 8px !important;
        padding: 9px 14px !important;
        border: 1px solid transparent !important;
    }

    html.fi.dark .fi-sidebar-item-btn:hover {
        background: rgba({{ $primaryRgb }}, 0.12) !important;
        border-color: {{ $activeConfig['border'] }} !important;
        box-shadow: 0 4px 12px {{ $activeConfig['glow'] }} !important;
        transform: translateY(-1px) !important;
    }

    /* Active Sidebar Navigation Item (Dark - Vibrant Skeuo 3D Embossed Glass Pill matching Student Step Cards) */
    html.fi.dark .fi-sidebar-item-active > .fi-sidebar-item-btn,
    html.fi.dark .fi-sidebar-item-btn.fi-active {
        background: linear-gradient(135deg, rgba({{ $primaryRgb }}, 0.38) 0%, rgba({{ $primaryRgb }}, 0.18) 100%) !important;
        border: 1px solid {{ $activeConfig['primary'] }} !important;
        box-shadow:
            0 6px 22px -2px {{ $activeConfig['glow'] }},
            inset 0 1px 1px rgba(255, 255, 255, 0.3),
            inset 0 -1px 2px rgba(0, 0, 0, 0.5) !important;
    }

    html.fi.dark .fi-sidebar-item-active .fi-sidebar-item-label {
        color: #ffffff !important;
        font-weight: 800 !important;
    }

    html.fi.dark .fi-sidebar-item-active .fi-sidebar-item-icon {
        color: {{ $activeConfig['primary'] }} !important;
        filter: drop-shadow(0 0 6px {{ $activeConfig['primary'] }}) !important;
    }

    html.fi.dark .fi-sidebar-item-label {
        color: #e2e8f0 !important;
        font-weight: 600 !important;
    }

    html.fi.dark .fi-sidebar-group-label {
        color: {{ $activeConfig['primary'] }} !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        font-size: 0.7rem !important;
    }

    /* 6. Frosted Glass Sections, Cards & Widgets (Dark) */
    html.fi.dark .fi-section,
    html.fi.dark .fi-ta-content,
    html.fi.dark .fi-wi-widget,
    html.fi.dark .fi-resource-table,
    html.fi.dark .fi-form-component-container,
    html.fi.dark .fi-wi-stats-overview-stat {
        background: rgba({{ $surfaceRgb }}, 0.85) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        -webkit-backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border: 1px solid {{ $activeConfig['border'] }} !important;
        border-top-color: rgba(255, 255, 255, 0.22) !important;
        border-bottom-color: rgba(0, 0, 0, 0.5) !important;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.7),
            0 0 25px {{ $activeConfig['glow'] }},
            inset 0 1px 1px rgba(255, 255, 255, 0.2),
            inset 0 -2px 4px rgba(0, 0, 0, 0.5) !important;
        border-radius: var(--skeuo-radius-lg) !important;
    }

    /* 7. Recessed Inset Input Wells (Dark) */
    html.fi.dark .fi-input-wrp,
    html.fi.dark .fi-fo-field-wrp input:not([type="checkbox"]):not([type="radio"]),
    html.fi.dark .fi-fo-field-wrp select,
    html.fi.dark .fi-fo-field-wrp textarea,
    html.fi.dark .fi-select-input {
        background: rgba({{ $elevatedRgb }}, 0.9) !important;
        border: 1px solid rgba(51, 65, 85, 0.8) !important;
        border-top-color: rgba(15, 23, 42, 0.9) !important;
        box-shadow:
            inset 0 3px 6px rgba(0, 0, 0, 0.65),
            inset 0 1px 2px rgba(0, 0, 0, 0.4),
            0 1px 0 rgba(255, 255, 255, 0.06) !important;
        color: #f8fafc !important;
        font-weight: 600 !important;
        transition: var(--skeuo-transition) !important;
        border-radius: var(--skeuo-radius-sm) !important;
    }

    html.fi.dark .fi-input-wrp:focus-within,
    html.fi.dark .fi-fo-field-wrp input:focus,
    html.fi.dark .fi-fo-field-wrp select:focus,
    html.fi.dark .fi-fo-field-wrp textarea:focus {
        border-color: {{ $activeConfig['primary'] }} !important;
        box-shadow:
            inset 0 3px 6px rgba(0, 0, 0, 0.65),
            0 0 0 3px rgba({{ $primaryRgb }}, 0.35),
            0 0 15px rgba({{ $primaryRgb }}, 0.25) !important;
        outline: none !important;
    }

    /* 8. Embossed 3D Primary Buttons (Dark) */
    html.fi.dark .fi-btn:not(.fi-btn-color-gray) {
        background: linear-gradient(180deg, {{ $activeConfig['btn_from'] }} 0%, {{ $activeConfig['btn_to'] }} 100%) !important;
        border: 1px solid {{ $activeConfig['btn_border'] }} !important;
        border-top-color: {{ $activeConfig['btn_top'] }} !important;
        border-bottom-color: {{ $activeConfig['btn_bottom'] }} !important;
        box-shadow:
            0 4px 14px rgba({{ $primaryRgb }}, 0.4),
            inset 0 1px 1px rgba(255, 255, 255, 0.4),
            inset 0 -2px 4px rgba(0, 0, 0, 0.3) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4) !important;
        border-radius: var(--skeuo-radius-md) !important;
        transition: var(--skeuo-transition) !important;
    }

    html.fi.dark .fi-btn:not(.fi-btn-color-gray):hover {
        box-shadow:
            0 6px 20px rgba({{ $primaryRgb }}, 0.55),
            inset 0 1px 2px rgba(255, 255, 255, 0.6) !important;
        transform: translateY(-1px) !important;
        filter: brightness(1.1) !important;
    }

    html.fi.dark .fi-btn:not(.fi-btn-color-gray):active {
        transform: translateY(1px) !important;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.5) !important;
    }

    /* 9. Secondary / Gray Buttons (Dark) */
    html.fi.dark .fi-btn-color-gray {
        background: rgba(30, 41, 59, 0.7) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 1px rgba(255, 255, 255, 0.12) !important;
        color: #e2e8f0 !important;
        font-weight: 600 !important;
        border-radius: var(--skeuo-radius-md) !important;
        transition: var(--skeuo-transition) !important;
    }

    html.fi.dark .fi-btn-color-gray:hover {
        transform: translateY(-1px) !important;
        background: rgba(51, 65, 85, 0.7) !important;
    }

    /* 10. Dropdowns & Modals (Dark) */
    html.fi.dark .fi-dropdown-panel,
    html.fi.dark .fi-modal-window {
        background: rgba({{ $surfaceRgb }}, 0.94) !important;
        backdrop-filter: blur(24px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(24px) saturate(180%) !important;
        border: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8) !important;
        border-radius: var(--skeuo-radius-lg) !important;
    }

    /* 11. Table Styling (Dark) */
    html.fi.dark .fi-ta-header-cell {
        background: rgba({{ $elevatedRgb }}, 0.85) !important;
        color: #94a3b8 !important;
        font-weight: 700 !important;
    }

    html.fi.dark .fi-ta-row:hover {
        background: rgba({{ $primaryRgb }}, 0.08) !important;
    }

    html.fi.dark .fi-header-heading {
        color: #f8fafc !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
    }

    /* ============================================================ */
    /* ☀️ LIGHT MODE (Filament: html.fi:not(.dark))                  */
    /* ============================================================ */

    html.fi:not(.dark) .fi-body {
        background-color: #f8fafc !important;
        background-image:
            radial-gradient(at 0% 0%, rgba({{ $primaryRgb }}, 0.12) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba({{ $accentRgb }}, 0.12) 0px, transparent 50%),
            radial-gradient(at 50% 50%, rgba(255, 255, 255, 0.6) 0px, transparent 100%) !important;
        color: #0f172a !important;
    }

    html.fi:not(.dark) .fi-topbar,
    html.fi:not(.dark) header.fi-topbar {
        background: rgba(255, 255, 255, 0.88) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        -webkit-backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border-bottom: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow: 0 4px 20px -2px {{ $activeConfig['glow'] }} !important;
    }

    html.fi:not(.dark) .fi-sidebar,
    html.fi:not(.dark) aside.fi-sidebar {
        background: rgba(255, 255, 255, 0.88) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        -webkit-backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border-right: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow: 6px 0 30px -5px {{ $activeConfig['glow'] }} !important;
    }

    html.fi:not(.dark) .fi-sidebar-item-btn:hover {
        background: rgba({{ $primaryRgb }}, 0.08) !important;
        border-color: {{ $activeConfig['border'] }} !important;
    }

    html.fi:not(.dark) .fi-sidebar-item-active > .fi-sidebar-item-btn,
    html.fi:not(.dark) .fi-sidebar-item-btn.fi-active {
        background: linear-gradient(135deg, rgba({{ $primaryRgb }}, 0.18) 0%, rgba({{ $primaryRgb }}, 0.08) 100%) !important;
        border: 1px solid {{ $activeConfig['primary'] }} !important;
        box-shadow: 0 4px 12px {{ $activeConfig['glow'] }} !important;
    }

    html.fi:not(.dark) .fi-sidebar-item-active .fi-sidebar-item-label {
        color: {{ $activeConfig['primary'] }} !important;
        font-weight: 800 !important;
    }

    html.fi:not(.dark) .fi-sidebar-item-active .fi-sidebar-item-icon {
        color: {{ $activeConfig['primary'] }} !important;
    }

    html.fi:not(.dark) .fi-section,
    html.fi:not(.dark) .fi-ta-content,
    html.fi:not(.dark) .fi-wi-widget,
    html.fi:not(.dark) .fi-resource-table,
    html.fi:not(.dark) .fi-form-component-container {
        background: rgba(255, 255, 255, 0.88) !important;
        backdrop-filter: blur(var(--skeuo-glass-blur)) saturate(180%) !important;
        border: 1px solid {{ $activeConfig['border'] }} !important;
        box-shadow: 0 15px 35px -10px {{ $activeConfig['glow'] }} !important;
        border-radius: var(--skeuo-radius-lg) !important;
    }

    html.fi:not(.dark) .fi-btn:not(.fi-btn-color-gray) {
        background: linear-gradient(180deg, {{ $activeConfig['btn_from'] }} 0%, {{ $activeConfig['btn_to'] }} 100%) !important;
        border: 1px solid {{ $activeConfig['btn_border'] }} !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 14px rgba({{ $primaryRgb }}, 0.35) !important;
    }

    /* Badges */
    html.fi:not(.dark) .fi-badge-success { background: rgba(16, 185, 129, 0.18) !important; border: 1px solid rgba(16, 185, 129, 0.4) !important; color: #047857 !important; font-weight: 700 !important; }
    html.fi.dark .fi-badge-success { background: rgba(16, 185, 129, 0.15) !important; border: 1px solid rgba(16, 185, 129, 0.4) !important; color: #34d399 !important; font-weight: 700 !important; }

    html.fi:not(.dark) .fi-badge-warning { background: rgba(245, 158, 11, 0.18) !important; border: 1px solid rgba(245, 158, 11, 0.4) !important; color: #b45309 !important; font-weight: 700 !important; }
    html.fi.dark .fi-badge-warning { background: rgba(245, 158, 11, 0.15) !important; border: 1px solid rgba(245, 158, 11, 0.4) !important; color: #fbbf24 !important; font-weight: 700 !important; }

    html.fi:not(.dark) .fi-badge-danger { background: rgba(244, 63, 94, 0.18) !important; border: 1px solid rgba(244, 63, 94, 0.4) !important; color: #be123c !important; font-weight: 700 !important; }
    html.fi.dark .fi-badge-danger { background: rgba(244, 63, 94, 0.15) !important; border: 1px solid rgba(244, 63, 94, 0.4) !important; color: #fb7185 !important; font-weight: 700 !important; }
</style>
