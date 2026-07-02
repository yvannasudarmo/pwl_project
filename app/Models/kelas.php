<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'table_kelas';

    protected $fillable = [
        'kode_kelas',
        'kode_mata_kuliah',
        'kode_dosen',
        'hari',
        'jam',
        'tahun_ajaran',
        'ruang_kelas',
        'jumlah_max',
        'jumlah_mahasiswa',
        'semester'
    ];

    public function ListHari(){
        return [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat'
        ];
    }

    public function ListJam(){
        return [
            '08:00 - 09:40',
            '09:50 - 11:30',
            '12:30 - 14:10',
            '17:00 - 18:40',
            '19:00 - 20:40'
        ];
    }
    
    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class, 'kode_mata_kuliah');
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'kode_dosen');
    }
}