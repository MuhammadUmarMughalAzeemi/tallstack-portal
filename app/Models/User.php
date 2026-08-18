<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string|null $plain_password
 * @property string|null $pmdc_pnmc
 * @property string|null $father_name
 * @property string|null $mobile_number
 * @property string|null $branch_code
 * @property string|null $branch_name
 * @property int|null $challan_id
 * @property bool $is_paid
 * @property int|null $amount
 * @property int|null $challan_amount
 * @property string|null $transaction_id
 * @property string|null $cnic_passport
 * @property int|null $cnic_passport_id
 * @property int|null $program_id
 * @property int|null $program_priority
 * @property int|null $affirmation
 * @property bool $accepted_terms_and_conditions
 * @property int $status
 * @property float|null $aggregate
 * @property float|null $aggregate_overseas
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property int $is_completed
 * @property int $is_completed_email
 * @property string|null $step_one_data
 * @property bool $profile_step_1_completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $getFirstMedia(string $collection)
 * @property-read \App\Models\PersonalDetail|null $personalDetails
 * @property-read \App\Models\Qualification|null $qualifications
 * @property-read \App\Models\AdmissionTest|null $admissionTest
 * @property-read \App\Models\Program|null $program
 * @property-read \App\Models\OTPS|null $otps
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeatCategory> $seatCategories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MphillPhdSubjects> $mphillPhdSubjects
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CollegePreference> $mbbsCollegePreferences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CollegePreference> $bdsCollegePreferences
 * @property-read \App\Models\UserPersonalInfo|null $personalInfo
 * @property-read \App\Models\UserAddress|null $address
 * @property-read \App\Models\UserEducation|null $education
 * @property-read \App\Models\UserExperience|null $experience
 * @property-read \App\Models\UserDocument|null $document
 * @property-read \App\Models\UserPreference|null $preference
 * @property-read \App\Models\UserSubmission|null $submission
 */
class User extends Authenticatable implements FilamentUser, HasMedia
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use InteractsWithMedia;

    // ─── Spatie Media Collections ───────────────────────────────────────────
    // Each constant is used as the collection name throughout the app.
    // Single-file collections use ->singleFile() so uploading replaces previous.
    // 'other-documents' is multi-file for user-defined additional uploads.

    public const MEDIA_CNIC                     = 'cnic';
    public const MEDIA_CNIC_BACK                = 'cnic-back';
    public const MEDIA_FATHER_CNIC              = 'father-cnic';
    public const MEDIA_FATHER_CNIC_BACK         = 'father-cnic-back';
    public const MEDIA_PHOTO                    = 'photo';
    public const MEDIA_SIGNATURE                = 'signature';
    public const MEDIA_DOMICILE                 = 'domicile';
    public const MEDIA_MATRIC_TRANSCRIPT        = 'matric-transcript';
    public const MEDIA_INTERMEDIATE_TRANSCRIPT  = 'intermediate-transcript';
    public const MEDIA_MDCAT_RESULT             = 'mdcat-result';
    public const MEDIA_OTHER_DOCUMENTS          = 'other-documents';

    /**
     * Register all Spatie media collections.
     * Called automatically by InteractsWithMedia.
     */
    public function registerMediaCollections(): void
    {
        // Identity Documents
        $this->addMediaCollection(self::MEDIA_CNIC)->singleFile();
        $this->addMediaCollection(self::MEDIA_CNIC_BACK)->singleFile();
        $this->addMediaCollection(self::MEDIA_FATHER_CNIC)->singleFile();
        $this->addMediaCollection(self::MEDIA_FATHER_CNIC_BACK)->singleFile();

        // Personal
        $this->addMediaCollection(self::MEDIA_PHOTO)->singleFile();
        $this->addMediaCollection(self::MEDIA_SIGNATURE)->singleFile();

        // Academic
        $this->addMediaCollection(self::MEDIA_DOMICILE)->singleFile();
        $this->addMediaCollection(self::MEDIA_MATRIC_TRANSCRIPT)->singleFile();
        $this->addMediaCollection(self::MEDIA_INTERMEDIATE_TRANSCRIPT)->singleFile();
        $this->addMediaCollection(self::MEDIA_MDCAT_RESULT)->singleFile();

        // Other documents — multiple files, each with a custom name
        $this->addMediaCollection(self::MEDIA_OTHER_DOCUMENTS);
    }

    // ─── Eloquent Relationships ─────────────────────────────────────────────

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->hasAnyRole(['admin', 'verifier'])) {
            return true;
        }

        try {
            return $this->hasPermissionTo('access admin panel');
        } catch (\Throwable) {
            return false;
        }
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'plain_password',
        'pmdc_pnmc',
        'father_name',
        'mobile_number',
        'transaction_id',
        'amount',
        'challan_amount',
        'branch_code',
        'branch_name',
        'challan_id',
        'program_id',
        'college_preference_id',
        'accepted_terms_and_conditions',
        'program_priority',
        'aggregate',
        'affirmation',
        'aggregate_overseas',
        'status',
        'comments',
        'submitted_at',
        'is_paid',
        'cnic_passport',
        'cnic_passport_id',
        'is_completed',
        'is_completed_email',
        'step1_completed',
        'step2_completed',
        'step3_completed',
        'step4_completed',
        'step5_completed',
        'step6_completed',
        'step7_completed',
        'step8_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'              => 'datetime',
            'submitted_at'                   => 'datetime',
            'password'                       => 'hashed',
            'is_paid'                        => 'boolean',
            'accepted_terms_and_conditions'  => 'boolean',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function mbbsCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 1);
    }

    public function bdsCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 0);
    }

    public function mphillPhdSubjects(): HasMany
    {
        return $this->hasMany(MphillPhdSubjects::class);
    }

    public function personalDetails(): HasOne
    {
        return $this->hasOne(PersonalDetail::class);
    }

    public function qualifications(): HasOne
    {
        return $this->hasOne(Qualification::class);
    }

    public function admissionTest(): HasOne
    {
        return $this->hasOne(AdmissionTest::class);
    }

    public function seatCategories(): BelongsToMany
    {
        return $this->belongsToMany(SeatCategory::class)
            ->withPivot('created_at', 'updated_at')
            ->using(SeatCategoryUser::class);
    }

    public function otps(): HasOne
    {
        return $this->hasOne(OTPS::class);
    }

    public function personalInfo(): HasOne
    {
        return $this->hasOne(UserPersonalInfo::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class);
    }

    public function education(): HasOne
    {
        return $this->hasOne(UserEducation::class);
    }

    public function experience(): HasOne
    {
        return $this->hasOne(UserExperience::class);
    }

    public function document(): HasOne
    {
        return $this->hasOne(UserDocument::class);
    }

    public function preference(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function submission(): HasOne
    {
        return $this->hasOne(UserSubmission::class);
    }
}
