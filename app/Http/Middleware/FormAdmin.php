<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAdmin extends Model
{
    use HasFactory;
    protected $table = 'formadmin';
    protected $fillable = [
        "ADMIN_NAME",
        "ADMIN_PASSWORD",
        "ADMIN_ID",
    ];  
}
