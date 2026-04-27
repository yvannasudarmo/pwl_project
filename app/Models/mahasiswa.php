<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "table_mhs";

    protected $fillable = [
        'Fullname',
        'NIM',
        'NISN',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Alamat'
    ];
}
