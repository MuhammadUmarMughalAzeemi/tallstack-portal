@php
    $setting = \App\Models\PortalSetting::current();
    $adminTheme = $setting->admin_theme ?? 'frost-sapphire';

    $getCustomGlassColors = function (\App\Models\PortalSetting $setting) {
        $customCss = $setting->custom_css ?? '';

        // Smart scale-aware parser: extract --variable-NNN: #hex pairs
        // Picks the correct shade for each role (500=primary, 400=accent, etc.)
        // instead of blindly picking the first hex (the near-white 50-shade)
        preg_match_all(
            '/--[\w-]+-(\d+)\s*:\s*(#[a-fA-F0-9]{6}|#[a-fA-F0-9]{3})\b/',
            $customCss, $scaleMatches, PREG_SET_ORDER
        );
        $shadeMap = [];
        foreach ($scaleMatches as $m) {
            $shadeMap[(int) $m[1]] = $m[2];
        }

        // Semantic shade mapping
        $primaryHex = $shadeMap[500] ?? $shadeMap[600] ?? '#9269e9'; // vibrant center
        $accentHex  = $shadeMap[400] ?? $shadeMap[300] ?? $primaryHex; // lighter highlight
        $darkHex    = $shadeMap[700] ?? $shadeMap[800] ?? '#4f278b';   // deep for gradient bottom
        $lightHex   = $shadeMap[300] ?? $shadeMap[200] ?? $accentHex;  // bright border top
        $deepHex    = $shadeMap[950] ?? $shadeMap[900] ?? '#1e0a3c';   // near-black source

        // Helper closure to parse hex -> [r, g, b]
        $toRgb = function ($hex) {
            $hex = ltrim($hex, '#');
            if (strlen($hex) === 3) {
                $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
            }
            return [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
        };

        [$r, $g, $b]    = $toRgb($primaryHex);
        [$r2, $g2, $b2] = $toRgb($accentHex);
        $deepRgbArr     = $toRgb($deepHex);

        // 50% MATCH: blend palette-derived deep color 50/50 with neutral admin dark
        // Admin is in the same color FAMILY as student but calmer/more professional
        $neutralBase = [8, 12, 22]; // ~#080c16
        $bgDarkRgb   = [
            (int) ($neutralBase[0] * 0.5 + $deepRgbArr[0] * 0.5),
            (int) ($neutralBase[1] * 0.5 + $deepRgbArr[1] * 0.5),
            (int) ($neutralBase[2] * 0.5 + $deepRgbArr[2] * 0.5),
        ];
        $bgDark = sprintf('#%02x%02x%02x', ...$bgDarkRgb);

        return [
            'accent'           => "{$r}, {$g}, {$b}",
            'accent2'          => "{$r2}, {$g2}, {$b2}",
            'light_focus'      => $primaryHex,
            'dark_focus'       => $shadeMap[400] ?? $primaryHex, // lighter for dark mode text
            'btn_from'         => $primaryHex,
            'btn_to'           => $darkHex,
            'btn_border'       => $accentHex,
            'btn_top'          => $lightHex,
            'btn_bottom'       => $shadeMap[800] ?? $darkHex,
            'btn_glow'         => "{$r}, {$g}, {$b}",
            'dark_glow'        => "{$r}, {$g}, {$b}",
            // 50% match: subdued canvas color + halved ambient gradient opacities
            'bg_dark'          => $bgDark,
            'ambient1_opacity' => '0.08',  // presets use 0.15 (50% = 0.075 ≈ 0.08)
            'ambient2_opacity' => '0.06',  // presets use 0.12 (50% = 0.06)
        ];
    };

    $themeColors = match ($adminTheme) {
        'custom-glass' => $getCustomGlassColors($setting),
        'frost-sapphire' => [
            'accent' => '99, 102, 241', 'accent2' => '14, 165, 233',
            'light_focus' => '#6366f1', 'dark_focus' => '#818cf8',
            'btn_from' => '#6366f1', 'btn_to' => '#4338ca',
            'btn_border' => '#818cf8', 'btn_top' => '#a5b4fc', 'btn_bottom' => '#312e81',
            'btn_glow' => '99, 102, 241', 'dark_glow' => '99, 102, 241',
        ],
        'emerald-glass' => [
            'accent' => '16, 185, 129', 'accent2' => '20, 184, 166',
            'light_focus' => '#10b981', 'dark_focus' => '#34d399',
            'btn_from' => '#10b981', 'btn_to' => '#047857',
            'btn_border' => '#34d399', 'btn_top' => '#6ee7b7', 'btn_bottom' => '#064e3b',
            'btn_glow' => '16, 185, 129', 'dark_glow' => '16, 185, 129',
        ],
        'obsidian-crystal' => [
            'accent' => '168, 85, 247', 'accent2' => '217, 70, 239',
            'light_focus' => '#a855f7', 'dark_focus' => '#c084fc',
            'btn_from' => '#a855f7', 'btn_to' => '#7c3aed',
            'btn_border' => '#c084fc', 'btn_top' => '#d8b4fe', 'btn_bottom' => '#4c1d95',
            'btn_glow' => '168, 85, 247', 'dark_glow' => '168, 85, 247',
        ],
        'luxe-gold' => [
            'accent' => '245, 158, 11', 'accent2' => '234, 179, 8',
            'light_focus' => '#f59e0b', 'dark_focus' => '#fbbf24',
            'btn_from' => '#f59e0b', 'btn_to' => '#b45309',
            'btn_border' => '#fbbf24', 'btn_top' => '#fde68a', 'btn_bottom' => '#78350f',
            'btn_glow' => '245, 158, 11', 'dark_glow' => '245, 158, 11',
        ],
        'rose-quartz' => [
            'accent' => '244, 63, 94', 'accent2' => '236, 72, 153',
            'light_focus' => '#f43f5e', 'dark_focus' => '#fb7185',
            'btn_from' => '#f43f5e', 'btn_to' => '#be123c',
            'btn_border' => '#fb7185', 'btn_top' => '#fda4af', 'btn_bottom' => '#881337',
            'btn_glow' => '244, 63, 94', 'dark_glow' => '244, 63, 94',
        ],
        default => [
            'accent' => '99, 102, 241', 'accent2' => '14, 165, 233',
            'light_focus' => '#6366f1', 'dark_focus' => '#818cf8',
            'btn_from' => '#6366f1', 'btn_to' => '#4338ca',
            'btn_border' => '#818cf8', 'btn_top' => '#a5b4fc', 'btn_bottom' => '#312e81',
            'btn_glow' => '99, 102, 241', 'dark_glow' => '99, 102, 241',
        ],
    };
@endphp

<style id="skeuo-dashboard-styles">
    /* ============================================================ */
    /* 🎨 SKEUO-GLASS CLASSES — LIVEWIRE ADMIN DASHBOARD            */
    /* Uses data-user-mode attribute for light/dark mode             */
    /* ============================================================ */

    .admin-page-bg {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ---- LIGHT MODE (data-user-mode="light") ---- */

    [data-user-mode="light"] .admin-theme-container {
        background-color: #f1f5f9 !important;
        background-image:
            radial-gradient(at 0% 0%, rgba({{ $themeColors['accent'] }}, 0.08) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba({{ $themeColors['accent2'] }}, 0.08) 0px, transparent 50%) !important;
        color: #0f172a !important;
    }

    [data-user-mode="light"] .skeuo-glass-card {
        background: rgba(255, 255, 255, 0.82) !important;
        backdrop-filter: blur(18px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(18px) saturate(180%) !important;
        border: 1px solid rgba(255, 255, 255, 0.95) !important;
        border-bottom-color: rgba(203, 213, 225, 0.7) !important;
        box-shadow:
            0 15px 35px -10px rgba(15, 23, 42, 0.08),
            0 4px 12px -2px rgba(15, 23, 42, 0.04),
            inset 0 1px 2px rgba(255, 255, 255, 1),
            inset 0 -1px 2px rgba(0, 0, 0, 0.03) !important;
        border-radius: 1.25rem !important;
    }

    [data-user-mode="light"] .skeuo-glass-input {
        background: rgba(248, 250, 252, 0.9) !important;
        border: 1px solid rgba(203, 213, 225, 0.9) !important;
        box-shadow: inset 0 2px 4px rgba(15, 23, 42, 0.08), 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        color: #0f172a !important;
        font-weight: 600 !important;
    }
    [data-user-mode="light"] .skeuo-glass-input:focus {
        border-color: {{ $themeColors['light_focus'] }} !important;
        box-shadow: inset 0 2px 4px rgba(15, 23, 42, 0.08), 0 0 0 3px rgba({{ $themeColors['accent'] }}, 0.25) !important;
        outline: none !important;
    }

    [data-user-mode="light"] .skeuo-text-heading { color: #0f172a !important; font-weight: 700 !important; }
    [data-user-mode="light"] .skeuo-text-subtext { color: #334155 !important; }

    [data-user-mode="light"] .skeuo-glass-table-head {
        background: rgba(226, 232, 240, 0.8) !important;
        border-bottom: 1px solid rgba(203, 213, 225, 0.9) !important;
        color: #1e293b !important;
        font-weight: 700 !important;
    }
    [data-user-mode="light"] .skeuo-glass-row:hover {
        background: rgba(241, 245, 249, 0.7) !important;
    }

    /* ---- DARK MODE (data-user-mode="dark") ---- */

    [data-user-mode="dark"] .admin-theme-container {
        /* 50% match for custom-glass: blended bg_dark; presets fall back to #080c16 */
        background-color: {{ $themeColors['bg_dark'] ?? '#080c16' }} !important;
        background-image:
            radial-gradient(at 0% 0%, rgba({{ $themeColors['accent'] }}, {{ $themeColors['ambient1_opacity'] ?? '0.15' }}) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba({{ $themeColors['accent2'] }}, {{ $themeColors['ambient2_opacity'] ?? '0.12' }}) 0px, transparent 50%) !important;
        color: #f8fafc !important;
    }

    [data-user-mode="dark"] .skeuo-glass-card {
        background: rgba(15, 23, 42, 0.72) !important;
        backdrop-filter: blur(18px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(18px) saturate(180%) !important;
        border: 1px solid rgba(255, 255, 255, 0.14) !important;
        border-top-color: rgba(255, 255, 255, 0.22) !important;
        border-bottom-color: rgba(0, 0, 0, 0.4) !important;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.65),
            0 0 25px rgba({{ $themeColors['dark_glow'] }}, 0.08),
            inset 0 1px 1px rgba(255, 255, 255, 0.18),
            inset 0 -2px 4px rgba(0, 0, 0, 0.5) !important;
        border-radius: 1.25rem !important;
    }

    [data-user-mode="dark"] .skeuo-glass-input {
        background: rgba(2, 6, 23, 0.85) !important;
        border: 1px solid rgba(51, 65, 85, 0.8) !important;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.65), 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        color: #f8fafc !important;
        font-weight: 600 !important;
    }
    [data-user-mode="dark"] .skeuo-glass-input:focus {
        border-color: {{ $themeColors['dark_focus'] }} !important;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.65), 0 0 0 3px rgba({{ $themeColors['accent'] }}, 0.35) !important;
        outline: none !important;
    }

    [data-user-mode="dark"] .skeuo-text-heading { color: #f8fafc !important; font-weight: 700 !important; }
    [data-user-mode="dark"] .skeuo-text-subtext { color: #cbd5e1 !important; }

    [data-user-mode="dark"] .skeuo-glass-table-head {
        background: rgba(2, 6, 23, 0.9) !important;
        border-bottom: 1px solid rgba(51, 65, 85, 0.8) !important;
        color: #94a3b8 !important;
        font-weight: 700 !important;
    }
    [data-user-mode="dark"] .skeuo-glass-row:hover {
        background: rgba(30, 41, 59, 0.5) !important;
    }

    /* ============================================================ */
    /* 🎨 EMBOSSED 3D BUTTONS                                       */
    /* ============================================================ */

    .skeuo-glass-btn-primary {
        background: linear-gradient(180deg, {{ $themeColors['btn_from'] }} 0%, {{ $themeColors['btn_to'] }} 100%) !important;
        border: 1px solid {{ $themeColors['btn_border'] }} !important;
        border-top-color: {{ $themeColors['btn_top'] }} !important;
        border-bottom-color: {{ $themeColors['btn_bottom'] }} !important;
        box-shadow:
            0 6px 18px rgba({{ $themeColors['btn_glow'] }}, 0.4),
            inset 0 1px 1px rgba(255, 255, 255, 0.5),
            inset 0 -2px 4px rgba(0, 0, 0, 0.3) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        border-radius: 0.875rem !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        cursor: pointer !important;
    }
    .skeuo-glass-btn-primary:hover {
        box-shadow:
            0 8px 25px rgba({{ $themeColors['btn_glow'] }}, 0.5),
            inset 0 1px 2px rgba(255, 255, 255, 0.7) !important;
        transform: translateY(-1px) !important;
        filter: brightness(1.1) !important;
    }
    .skeuo-glass-btn-primary:active {
        transform: translateY(1.5px) !important;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.4) !important;
    }

    .skeuo-glass-btn-emerald {
        background: linear-gradient(180deg, #10b981 0%, #047857 100%) !important;
        border: 1px solid #34d399 !important;
        border-top-color: #6ee7b7 !important;
        border-bottom-color: #064e3b !important;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.5) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        border-radius: 0.875rem !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        cursor: pointer !important;
    }
    .skeuo-glass-btn-emerald:hover {
        background: linear-gradient(180deg, #34d399 0%, #059669 100%) !important;
        transform: translateY(-1px) !important;
    }
    .skeuo-glass-btn-emerald:active {
        transform: translateY(1.5px) !important;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.4) !important;
    }

    .skeuo-glass-btn-secondary {
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), inset 0 1px 1px rgba(255, 255, 255, 0.4) !important;
        border-radius: 0.875rem !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        cursor: pointer !important;
    }
    [data-user-mode="light"] .skeuo-glass-btn-secondary {
        color: #1e293b !important;
        background: rgba(255, 255, 255, 0.7) !important;
        border-color: rgba(203, 213, 225, 0.8) !important;
    }
    [data-user-mode="dark"] .skeuo-glass-btn-secondary {
        color: #f1f5f9 !important;
        background: rgba(30, 41, 59, 0.6) !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    .skeuo-glass-btn-secondary:hover {
        transform: translateY(-1px) !important;
        filter: brightness(1.1) !important;
    }

    /* ============================================================ */
    /* 🏷️ SKEUO-GLASS BADGES                                        */
    /* ============================================================ */

    .skeuo-badge-success {
        background: rgba(16, 185, 129, 0.15) !important;
        border: 1px solid rgba(16, 185, 129, 0.4) !important;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3) !important;
        color: #10b981 !important;
        font-weight: 700 !important;
    }
    [data-user-mode="light"] .skeuo-badge-success { color: #047857 !important; }

    .skeuo-badge-warning {
        background: rgba(245, 158, 11, 0.15) !important;
        border: 1px solid rgba(245, 158, 11, 0.4) !important;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3) !important;
        color: #f59e0b !important;
        font-weight: 700 !important;
    }
    [data-user-mode="light"] .skeuo-badge-warning { color: #b45309 !important; }

    .skeuo-badge-danger {
        background: rgba(244, 63, 94, 0.15) !important;
        border: 1px solid rgba(244, 63, 94, 0.4) !important;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3) !important;
        color: #f43f5e !important;
        font-weight: 700 !important;
    }
    [data-user-mode="light"] .skeuo-badge-danger { color: #be123c !important; }

    .skeuo-glass-table-container {
        border-radius: 0.875rem !important;
        overflow: hidden !important;
    }
</style>
