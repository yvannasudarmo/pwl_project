<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class krs extends Model
{
    protected $table = 'table_krs';

    protected $fillable = [
        'NIM',
        'tahun_ajaran',
        'semester',
        'status',
        'total_sks'
    ];

    public function mahasiswa() {
        return $this->hasOne(Mahasiswa::class, 'id', 'NIM');
    }

    public function detail() {
        return $this->hasMany(KRSDetail::class, 'krs_id', 'id');
    }
}