<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'pelanggan_id',
        'nama_pelanggan'            ,
        'tanggal_lahir'             ,
        'tempat_lahir'              ,
        'agama'                     ,
        'gender'                    ,
        'nama_ayah'                 ,
        'nama_ibu'                  ,
        'nik_pelanggan'             ,
        'npwp_pelanggan'            ,
        'nppkp_pelanggan'           ,
        'pajak_1_pelanggan'         ,
        'pajak_2_pelanggan'         ,
        'penjual'                   ,
        'tipe_pelanggan'            ,
        'level_harga_pelanggan'     ,
        'diskon_penjualan_pelanggan',
        'syarat_pelanggan'          ,
        'batas_maks_hutang'         ,
        'batas_umur_hutang'         ,
        'mata_uang_pelanggan'       ,
        'saldo_awal_pelanggan'      ,
        'tanggal_pelanggan'         ,
        'deskripsi'                 ,
        'status'                    ,
        'dihentikan'                ,
        'alamat_1'                  ,
        'alamat_2'                  ,
        'alamatpajak_1'             ,
        'alamatpajak_2'             ,
        'negara'                    ,
        'kota'                      ,
        'provinsi'                  ,
        'kode_pos'                  ,
        'kontak'                    ,
        'no_telp'                   ,
        'no_fax'                    ,
        'email'                     ,
        'website'                   ,
        'memo'                      ,
        'fileupload_1'              ,
        'fileupload_2'              ,
        'fileupload_3'              ,
        'fileupload_4'              ,
        'fileupload_5'              ,
        'fileupload_6'              ,
        'fileupload_7'              ,
        'fileupload_7'              ,

    ];


    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('pelanggan_id', 'desc')->first();
            $prefix = 'GMPSCR-';
            $nextID = $latestUser ? intval(substr($latestUser->pelanggan_id, strlen($prefix))) : 1;
            $model->pelanggan_id = $prefix . sprintf("%04d", $nextID);
            while (self::where('pelanggan_id', $model->pelanggan_id)->exists()) {
                $nextID++;
                $model->pelanggan_id = $prefix . sprintf("%04d", $nextID);
            }
        });
    }
}
