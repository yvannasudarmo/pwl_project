<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    protected $table = "table_dosen";

    protected $fillable = [
        'Fullname',
        'NIM',
        'NIDN',
        'Pendidikan_Terakhir',
        'Jurusan_id',
        'Tempat_lahir',
        'Tanggal_lahir',
        'Alamat'
    ];
}
