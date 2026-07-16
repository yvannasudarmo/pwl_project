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
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'nim');
    }

    /**
     * PERBAIKAN: Menambahkan relasi 'detail' yang dicari oleh Controller
     * Hubungan: Satu KRS memiliki banyak detail item mata kuliah (HasMany)
     */
    public function detail()
    {
        // Parameter 2: 'krs_id' atau 'kode_krs' adalah kolom foreign key di tabel detail KRS Anda.
        // Silakan sesuaikan nama model detail Anda (misal: DetailKRS atau KRSDetail)
        return $this->hasMany(KRSDetail::class, 'krs_id', 'id');
    }
}