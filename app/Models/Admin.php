<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'formadmin';      
    protected $primaryKey = 'ADMIN_ID';  // primary key
    public $timestamps = false;          
    protected $fillable = [
        'ADMIN_NAME',
        'ADMIN_PASSWORD'
    ];
}
