<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SscExamPassed extends Model
{
    use HasFactory;

    protected $table = 'ssc_exam';

    protected $fillable = ['name'];
}
