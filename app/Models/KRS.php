<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KRS extends Model
{
    protected $table = 'table_krs'; // Sesuaikan dengan nama tabel Anda

    // Jika primary key Anda bukan 'id' melainkan 'kode_mahasiswa', aktifkan ini:
    // protected $primaryKey = 'kode_mahasiswa';
    // public $incrementing = false;

    protected $fillable = [
        'kode_mahasiswa',
        'tahun_ajaran',
        'semester',
        'total_sks'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'kode_mahasiswa');
    }
}