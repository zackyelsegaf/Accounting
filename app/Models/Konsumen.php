<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumen';

    protected $fillable = [
        'nama_konsumen'   ,
        'nik_konsumen'    ,
        'no_hp'           ,
        'status_pengajuan',
        'jenis_kelamin'   ,
        'cluster'         ,
        'provinsi'        ,
        'kota'            ,
        'kecamatan'       ,
        'kelurahan'       ,
        'alamat_konsumen' ,
        'pekerjaan'       ,
        'marketing'       ,
        'nik_pasangan'    ,
        'nama_pasangan'   ,
        'no_hp_pasangan'  ,
    ];
}
