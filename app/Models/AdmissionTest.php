<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\AdmissionTest
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $md_cat_cnic
 * @property string|null $md_cat_obtained_marks
 * @property string|null $sat_test_date
 * @property int|null $sat_biology_obtained_marks
 * @property int|null $sat_chemistry_obtained_marks
 * @property int|null $sat_phy_math_obtained_marks
 * @property string|null $sat_username
 * @property string|null $sat_password
 * @property string|null $ucat_band
 * @property string|null $ucat_obtained_marks
 * @property string|null $ucat_candidate_id
 * @property string|null $ucat_test_date
 * @property string|null $mcat_obtained_marks
 * @property string|null $mcat_test_date
 * @property string|null $mcat_username
 * @property string|null $mcat_password
 * @property int|null $md_catCenter_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class AdmissionTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'md_cat_cnic',
        'md_cat_obtained_marks',
        'sat_test_date',
        'sat_biology_obtained_marks',
        'sat_chemistry_obtained_marks',
        'sat_phy_math_obtained_marks',
        'sat_username',
        'sat_password',
        'ucat_test_date',
        'ucat_band',
        'ucat_obtained_marks',
        'ucat_username',
        'ucat_password',
        'mcat_obtained_marks',
        'mcat_test_date',
        'mcat_username',
        'mcat_password',
        'md_catCenter_id',
        'ucat_candidate_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mdcatCenter(): HasOne
    {
        return $this->hasOne(MdcatCenter::class, 'id', 'md_catCenter_id');
    }
}
