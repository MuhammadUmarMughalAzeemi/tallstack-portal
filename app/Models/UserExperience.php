<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $table = 'user_experiences';
    protected $fillable = ['user_id', 'job_title', 'company', 'years_experience'];
}
