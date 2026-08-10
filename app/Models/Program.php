<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Program
 *
 * @property int $id
 * @property string $name
 * @property int $challan_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'challan_type_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function colleges(): HasMany
    {
        return $this->hasMany(College::class);
    }
}
