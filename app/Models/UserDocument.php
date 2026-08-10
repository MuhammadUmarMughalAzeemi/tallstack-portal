<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $id_proof_path
 * @property string|null $transcript_path
 * @property string|null $id_metadata
 * @property string|null $transcript_metadata
 */
class UserDocument extends Model
{
    protected $table = 'user_documents';
    protected $fillable = ['user_id', 'id_proof_path', 'transcript_path', 'id_metadata', 'transcript_metadata'];
}
