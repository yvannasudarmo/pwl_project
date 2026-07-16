<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KRS extends Model
{
    // 1. Deklarasi nama tabel di database
    protected $table = 'table_krs'; 

    // 2. Kolom yang diizinkan untuk diisi massal (Mass Assignment)
    protected $fillable = [
        'kode_mahasiswa', // Kolom foreign key penampung NIM di tabel KRS
        'tahun_ajaran',
        'semester',
        'total_sks'
    ];

    /**
     * Relasi ke model Mahasiswa
     * Hubungan: Banyak data KRS dimiliki oleh satu Mahasiswa (BelongsTo)
     */
    public function mahasiswa()
    {
        // Parameter 2: 'kode_mahasiswa' adalah kolom FK di table_krs
        // Parameter 3: 'nim' adalah kolom PK asli di table_mhs (menggantikan kode_mahasiswa yang memicu error)
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'nim');
    }
}