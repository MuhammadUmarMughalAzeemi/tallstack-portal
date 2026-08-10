<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $active_theme
 * @property string $primary_color
 * @property string $accent_color
 * @property string $bg_color
 * @property string|null $custom_css
 * @property string $admin_theme
 * @property string $admin_primary_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class PortalSetting extends Model
{
    protected $fillable = [
        'active_theme',
        'admin_theme',
        'custom_css',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'active_theme' => 'custom',
            ]
        );
    }
}
