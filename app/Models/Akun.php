<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';

    protected $fillable = [
        'no_akun',
        'tipe_akun',
        'nama_akun_indonesia',
        'nama_akun_inggris',
        'mata_uang',
        'sub_akun_check',
        'sub_akun',
        'saldo_akun',
        'tanggal',
        'dihentikan',
    ];
}
