<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property bool|int $declaration
 * @property string|null $submitted_at
 */
class UserSubmission extends Model
{
    protected $table = 'user_submissions';
    protected $fillable = ['user_id', 'declaration', 'submitted_at'];
}
