<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        "NO_NEWS",
        "ADMIN_ID",
        "FOTO_NEWS",
        "JUDUL_NEWS",
        "TGL_LOKASI",
        "ISI_NEWS",
        "created_at",
        "updated_at"
    ];
}
