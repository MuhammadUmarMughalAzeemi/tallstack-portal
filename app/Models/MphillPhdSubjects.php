<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MphillPhdSubjects extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subject', 'seat_category_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
