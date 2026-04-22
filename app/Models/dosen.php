<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    protected $table = "table_dosen";

    protected $fillable = [
        'fullname',
        'NIM',
        'NIDN',
        'Pendidikan_Terakhir',
        'jurusan_id',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat'
    ];
}
