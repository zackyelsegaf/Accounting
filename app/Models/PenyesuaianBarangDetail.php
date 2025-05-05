<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyesuaianBarangDetail extends Model
{
    use HasFactory;

    protected $table = 'penyesuaian_barang_detail';

    protected $fillable = [
        'penyesuaian_barang_id',
        'no_barang',
        'deskripsi_barang',
        'kts_saat_ini',
        'kts_baru',
        'nilai_saat_ini',
        'nilai_baru',
        'departemen',
        'proyek',
        'gudang',
    ];

    public function rincian()
    {
        return $this->belongsTo(PenyesuaianBarang::class);
    }
}
