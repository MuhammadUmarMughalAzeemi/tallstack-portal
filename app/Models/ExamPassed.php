<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPassed extends Model
{
    use HasFactory;

    protected $table = 'examination';

    protected $fillable = ['name'];
}
