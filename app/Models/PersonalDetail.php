<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PersonalDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string $mother_name
 * @property string $date_of_birth
 * @property string $mobile_number
 * @property string|null $telephone_number
 * @property int|null $gender_id
 * @property int|null $residence_area_id
 * @property string $address
 * @property int|null $district_id
 * @property int|null $nationality_id
 * @property string|null $cnic_passport
 * @property int|null $cnic_passport_id
 * @property bool $showInput
 * @property string|null $secondary_number
 * @property string $city
 * @property string $country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class PersonalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mother_name',
        'date_of_birth',
        'mobile_number',
        'telephone_number',
        'gender_id',
        'residence_area_id',
        'address',
        'district_id',
        'nationality_id',
        'secondary_number',
        'country',
        'city',
        'cnic_passport',
        'cnic_passport_id',
        'showInput',
    ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function cnicPassport(): BelongsTo
    {
        return $this->belongsTo(CnicPassport::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(ResidenceArea::class, 'residence_area_id', 'id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
