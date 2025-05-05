<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';

    protected $fillable = [
        'proyek_id'                ,
        'nama_proyek'              ,
        'nama_kontak'              ,
        'tanggal_from'             ,
        'tanggal_to'               ,
        'persentase_komplet'       ,
        'persentase_komplet_check' ,
        'deskripsi'                ,
        'dihentikan'               ,
    ];

    // /** generate id */
    // protected static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $latestUser = self::orderBy('proyek_id', 'desc')->first();
    //         $prefix = 'GMPC-';
    //         $nextID = $latestUser ? intval(substr($latestUser->proyek_id, strlen($prefix))) : 1;
    //         $model->proyek_id = $prefix . sprintf("%04d", $nextID);
    //         while (self::where('proyek_id', $model->proyek_id)->exists()) {
    //             $nextID++;
    //             $model->proyek_id = $prefix . sprintf("%04d", $nextID);
    //         }
    //     });
    // }
}
