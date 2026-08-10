<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPersonalInfo extends Model
{
    protected $table = 'user_personal_infos';
    protected $fillable = ['user_id', 'full_name', 'email', 'phone'];
}
