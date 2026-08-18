<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MphilExam extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];
}
