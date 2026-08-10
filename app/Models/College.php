<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\College
 *
 * @property int $id
 * @property int|null $seat_category_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seat_category_id',
        'isBds',
        'program_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
