<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $table = 'user_educations';
    protected $fillable = ['user_id', 'degree', 'institution', 'graduation_year', 'cgpa'];
}
