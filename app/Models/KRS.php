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

    /**
     * Relasi ke model Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'NIM');
    }

    /**
     * Relasi ke model Detail KRS (Jika menggunakan tabel log terpisah)
     */
    public function detail()
    {
        return $this->hasMany(KRSDetail::class, 'krs_id', 'id');
    }

    /**
     * PERBAIKAN UTAMA: Definisikan relasi Many-to-Many ke Kelas dengan custom key
     * Gantilah 'krs_kelas' dengan nama tabel pivot/tabel penghubung Anda yang sebenarnya di DB
     */
    public function kelas()
    {
        return $this->belongsToMany(
            Kelas::class, 
            'krs_kelas',       // Nama tabel pivot penghubung KRS & Kelas
            'krs_id',          // Foreign key model KRS di tabel pivot
            'kode_kelas',      // Foreign key model Kelas di tabel pivot
            'id',              // Local key di tabel table_krs
            'kode_kelas'       // Related key di tabel table_kelas
        );
    }
}