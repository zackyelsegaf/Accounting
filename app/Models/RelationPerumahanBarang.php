<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationPerumahanBarang extends Model
{
    use HasFactory;

    protected $table = 'rlt_perumahan_to_barang';

    protected $fillable = ['barang_id', 'nama_perumahan', 'stok_barang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
}
