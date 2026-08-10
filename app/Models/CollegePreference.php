<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CollegePreference
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $college_pref
 * @property bool $is_mbbs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class CollegePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_pref',
        'user_id',
        'is_mbbs',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
