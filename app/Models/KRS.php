<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KRS extends Model
{
    protected $table = 'table_krs'; 

    protected $fillable = [
        'kode_mahasiswa', 
        'tahun_ajaran',
        'semester',
        'total_sks'
    ];

    public function mahasiswa()
    {
        // Menghubungkan kode_mahasiswa (tabel KRS) ke kolom NIM (tabel Mahasiswa) dengan case-sensitive yang tepat
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'NIM');
    }

    public function detail()
    {
        return $this->hasMany(KRSDetail::class, 'krs_id', 'id');
    }
}