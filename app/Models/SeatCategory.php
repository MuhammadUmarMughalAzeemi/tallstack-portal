<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\SeatCategory
 *
 * @property int $id
 * @property string $name
 * @property int $challan_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class SeatCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'challan_type_id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('created_at', 'updated_at')
            ->using(SeatCategoryUser::class);
    }

    public function usesRankedPreferences(): bool
    {
        $normalized = strtoupper((string) preg_replace('/[^A-Za-z0-9]/', '', $this->name));

        return str_contains($normalized, 'MPHIL');
    }
}
