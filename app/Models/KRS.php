<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KRS extends Model
{
    // 1. Deklarasi nama tabel di database
    protected $table = 'table_krs'; 

    // 2. Kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'kode_mahasiswa', 
        'tahun_ajaran',
        'semester',
        'total_sks'
    ];

    /**
     * Relasi ke model Mahasiswa
     * Hubungan: Banyak data KRS dimiliki oleh satu Mahasiswa
     */
    public function mahasiswa()
    {
        // PENTING: Pastikan parameter ke-3 ('NIM') persis sama dengan nama kolom di database Anda
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'NIM');
    }

    /**
     * Relasi ke model Detail KRS
     * Hubungan: Satu data induk KRS memiliki banyak rincian kelas/matakuliah
     */
    public function detail()
    {
        // Pastikan Anda sudah membuat file model KRSDetail.php
        return $this->hasMany(KRSDetail::class, 'krs_id', 'id');
    }
}