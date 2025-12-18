<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membeli extends Model
{
    use HasFactory;
    protected $table = 'membeli';
    
    protected $fillable = [
        "trx_id",             
        "NIK",
        "ID_PRODUCT",
        "qty",                
        "total_harga",        
        "nama_penerima",      
        "alamat_pengiriman",  
        "no_wa",             
        "status",
        "created_at",
        "updated_at"       
    ];
}