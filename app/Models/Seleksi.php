<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    use HasFactory;

    protected $table = 'seleksi'; // Nama tabel

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'status_tahap_1',
        'judul_essay',
        'status_tahap_2',
        'sudah_wawancara',
        'status_final'
    ];

    // Relasi Balik ke User (PENTING)
    public function user()
    {
        return $this->belongsTo(FormUser::class, 'nik', 'NIK');
    }
}