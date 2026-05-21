<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    protected $table = "table_matakuliah";

    protected $fillable = [
        'jurusan_id',
        'Kode_MK',
        'Nama_MK',
        'SKS',
        'Dosen_Id'
    ];
}
