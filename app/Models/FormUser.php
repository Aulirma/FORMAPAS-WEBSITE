<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FormUser extends Authenticatable
{
    protected $table = 'formuser';
    protected $primaryKey = 'NIK';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'USER_NAME',
        'USER_EMAIL',
        'USER_PASSWORD',
        'NIK',
        'ADMIN_ID',
        'MBTI_RESULT'
    ];

    protected $hidden = [
        'USER_PASSWORD',
    ];
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->USER_PASSWORD;
    }
}
