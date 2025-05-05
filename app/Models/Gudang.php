<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';

    protected $fillable = [
        'nama_gudang',
        'alamat_gudang_1',
        'alamat_gudang_2',
        'alamat_gudang_3',
        'penanggung_jawab',
        'deskripsi',
    ];
}
