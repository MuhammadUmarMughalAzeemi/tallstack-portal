<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbbsPassed extends Model
{
    use HasFactory;

    protected $table = 'mbbs_exams';

    protected $fillable = ['name'];
}
