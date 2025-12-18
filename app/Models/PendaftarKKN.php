<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarKKN extends Model
{
    protected $table = 'pendaftar_kkn';
    public $timestamps = false; 

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'universitas',
        'tahun_masuk',
        'ttl',
        'foto',
        'status',
        'tanggal_ajuan',
        'tanggal_konfirmasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'NIK');
    }
}
