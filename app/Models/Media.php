<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $mediaable_type
 * @property string $mediaable_id
 * @property string $name
 * @property string $path
 * @property string $disk
 * @property string|null $size
 * @property string|null $collection
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediaable_type',
        'mediaable_id',
        'name',
        'path',
        'disk',
        'size',
        'collection',
    ];

    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
}
