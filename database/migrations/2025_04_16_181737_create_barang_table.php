<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('tipe_barang')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->string('tipe_persediaan')->nullable();
            $table->string('kategori_barang')->nullable();
            $table->boolean('sub_barang_check')->nullable()->default(false);
            $table->string('sub_barang')->nullable();
            $table->string('deskripsi_1')->nullable();
            $table->string('deskripsi_2')->nullable();
            $table->string('default_gudang')->nullable();
            $table->string('departemen')->nullable();
            $table->string('proyek')->nullable();
            $table->string('diskon')->nullable();
            $table->string('kode_pajak')->nullable();
            $table->string('pemasok')->nullable();
            $table->string('minimum_kuantitas_pesan_ulang')->nullable();
            $table->string('kuantitas_saldo_awal')->nullable();
            $table->string('biaya_satuan_saldo_awal')->nullable();
            $table->string('total_saldo_awal')->nullable();
            $table->string('kuantitas_saldo_sekarang')->nullable();
            $table->string('harga_satuan_sekarang')->nullable();
            $table->string('biaya_pokok_sekarang')->nullable();
            $table->string('gudang')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('minimal_harga_jual')->nullable();
            $table->string('maksimal_harga_jual')->nullable();
            $table->string('minimal_harga_beli')->nullable();
            $table->string('maksimal_harga_beli')->nullable();
            $table->string('nomor_upc')->nullable();
            $table->string('nomor_plu')->nullable();
            $table->string('fileupload_1')->nullable();
            $table->string('fileupload_2')->nullable();
            $table->string('fileupload_3')->nullable();
            $table->string('fileupload_4')->nullable();
            $table->string('fileupload_5')->nullable();
            $table->string('fileupload_6')->nullable();
            $table->string('fileupload_7')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
