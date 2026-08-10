<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OTPS
 *
 * @property int $id
 * @property int $user_id
 * @property int $otp_type_id
 * @property int $otp_reason_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $used_at
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property bool $is_verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class OTPS extends Model
{
    use HasFactory;

    protected $table = 'o_t_p_s';

    protected $fillable = [
        'user_id',
        'otp_type_id',
        'otp_reason_id',
        'value',
        'used_at',
        'sent_at',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'used_at' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
