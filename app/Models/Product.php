<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'ID_PRODUCT';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_PRODUCT',
        'JENIS_PRODUCT',
        'HARGA_PRODUCT',
        'FOTO_PRODUCT',
        'ADMIN_ID'
    ];
}
