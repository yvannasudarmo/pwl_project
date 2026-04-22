<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $table = "table_jurusan";

        protected $fillable = [
        'Nama_Jurusan',
        'Kode_Jurusan'
    ];
}
