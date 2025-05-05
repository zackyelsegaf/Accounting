<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;

    protected $table = 'pemasok';

    protected $fillable = [
        'pemasok_id',
        'nama',
        'status',
        'kode_pos',
        'provinsi',
        'kota',
        'negara',
        'alamat_1',
        'alamat_2',
        'alamatpajak_1',
        'alamatpajak_2',
        'kontak',
        'no_telp',
        'no_fax',
        'email',
        'website',
        'memo',
        'fileupload_1',
        'dihentikan',
        'npwp',
        'pajak_1',
        'pajak_2',
        'syarat',
        'mata_uang',
        'saldo_awal',
        'tanggal',
        'deskripsi',
        'no_pkp',
        // 'fileupload_2',
        // 'fileupload_3',
        // 'fileupload_4',
        // 'fileupload_5',
        // 'fileupload_6',
        // 'fileupload_7',
    ];

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('pemasok_id', 'desc')->first();
            $nextID = $latestUser ? intval(substr($latestUser->pemasok_id, 3)) + 1 : 1;
            $model->pemasok_id = 'TB-' . sprintf("%04d", $nextID);

            while (self::where('pemasok_id', $model->pemasok_id)->exists()) {
                $nextID++;
                $model->pemasok_id = 'TB-' . sprintf("%04d", $nextID);
            }
        });
    }
}
