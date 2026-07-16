<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'table_kelas'; 
    protected $primaryKey = 'kode_kelas'; // Mengunci primary key ke kode_kelas

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_kelas',
        'hari',
        'jam',
        'ruang_kelas',
        'jumlah_max',
        'matakuliah_id',
        'dosen_id'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}