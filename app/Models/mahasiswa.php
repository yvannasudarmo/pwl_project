<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = "table_mahasiswa";

    protected $fillable = [
        'fullname',
        'NIM',
        'NIDN',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat'
    ];
}
