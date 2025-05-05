<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RelationPerumahanBarang;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'no_barang',
        'nama_barang',
        'tipe_barang',
        'tipe_persediaan',
        'kategori_barang',
        'sub_barang_check',
        'sub_barang',
        'deskripsi_1',
        'deskripsi_2',
        'default_gudang',
        'departemen',
        'proyek',
        'dihentikan',
        'diskon',
        'kode_pajak',
        'pemasok',
        'minimum_kuantitas_pesan_ulang',
        'kuantitas_saldo_awal',
        'biaya_satuan_saldo_awal',
        'total_saldo_awal',
        'kuantitas_saldo_sekarang',
        'harga_satuan_sekarang',
        'biaya_pokok_sekarang',
        'gudang',
        'tanggal_mulai',
        'minimal_harga_jual',
        'maksimal_harga_jual',
        'minimal_harga_beli',
        'maksimal_harga_beli',
        'nomor_upc',
        'nomor_plu',
        'satuan',
        'rasio',
        'level_harga_1',
        'level_harga_2',
        'level_harga_3',
        'level_harga_4',
        'level_harga_5',
        'harga_beli',
        'merk_barang',
    ];
}
