<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Qualification
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $ssc_science_subjects
 * @property string|null $ssc_passing_year
 * @property int|null $ssc_marks_obtained
 * @property int|null $ssc_total_marks
 * @property string|null $hssc_science_subjects
 * @property string|null $hssc_passing_year
 * @property int|null $hssc_marks_obtained
 * @property int|null $hssc_total_marks
 * @property int|null $ssc_board_id
 * @property int|null $ssc_exam_passeds_id
 * @property int|null $hssc_exam_passeds_id
 * @property int|null $hssc_board_id
 * @property int|null $ssc_institution_id
 * @property int|null $hssc_institution_id
 * @property string|null $mbbs_science_subjects
 * @property string|null $mbbs_passing_year
 * @property string|null $mbbs_marks_obtained
 * @property string|null $mbbs_total_marks
 * @property string|null $mbbs_board_id
 * @property int|null $mbbs_exam_passeds_id
 * @property int|null $mbbs_institution_id
 * @property string|null $mphil_science_subjects
 * @property string|null $mphil_passing_year
 * @property string|null $mphil_marks_obtained
 * @property string|null $mphil_total_marks
 * @property string|null $mphil_board_id
 * @property string|null $mphil_exam_passeds_id
 * @property int|null $mphil_institution_id
 * @property bool $is_experience
 * @property string|null $experiences
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ssc_exam_passeds_id',
        'ssc_science_subjects',
        'ssc_institution_id',
        'hssc_institution_id',
        'ssc_passing_year',
        'ssc_marks_obtained',
        'ssc_total_marks',
        'hssc_exam_passeds_id',
        'hssc_science_subjects',
        'hssc_passing_year',
        'hssc_marks_obtained',
        'hssc_total_marks',
        'ssc_board_id',
        'hssc_board_id',
        'mbbs_exam_passeds_id',
        'mbbs_science_subjects',
        'mbbs_institution_id',
        'mbbs_passing_year',
        'mbbs_marks_obtained',
        'mbbs_total_marks',
        'mbbs_board_id',
        'mphil_exam_passeds_id',
        'mphil_science_subjects',
        'mphil_institution_id',
        'mphil_passing_year',
        'mphil_marks_obtained',
        'mphil_total_marks',
        'mphil_board_id',
        'is_experience',
        'experiences',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function boards(): HasOne
    {
        return $this->hasOne(Boards::class);
    }

    public function sscExam(): HasOne
    {
        return $this->hasOne(SscExamPassed::class, 'id', 'ssc_exam_passeds_id');
    }

    public function mbbsExam(): HasOne
    {
        return $this->hasOne(MbbsPassed::class, 'id', 'mbbs_exam_passeds_id');
    }

    public function hsscExam(): HasOne
    {
        return $this->hasOne(ExamPassed::class, 'id', 'hssc_exam_passeds_id');
    }

    public function hsscInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'hssc_institution_id');
    }

    public function mbbsInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'mbbs_institution_id');
    }

    public function mphilInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'mphil_institution_id');
    }

    public function sscInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'ssc_institution_id');
    }

    public function sscBoard(): HasOne
    {
        return $this->hasOne(Boards::class, 'id', 'ssc_board_id');
    }

    public function hsscBoard(): HasOne
    {
        return $this->hasOne(Boards::class, 'id', 'hssc_board_id');
    }

    public function institutiontype(): HasOne
    {
        return $this->hasOne(InstitutionType::class);
    }
}
