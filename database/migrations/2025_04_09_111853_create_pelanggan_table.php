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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('pelanggan_id');
            $table->string('nama_pelanggan')->nullable();
            $table->string('nik_pelanggan')->nullable();
            $table->string('npwp_pelanggan')->nullable();
            $table->string('nppkp_pelanggan')->nullable();
            $table->string('pajak_1_pelanggan')->nullable();
            $table->string('pajak_2_pelanggan')->nullable();
            $table->string('penjual')->nullable();
            $table->string('tipe_pelanggan')->nullable();
            $table->string('level_harga_pelanggan')->nullable();
            $table->string('diskon_penjualan_pelanggan')->nullable();
            $table->string('syarat_pelanggan')->nullable();
            $table->string('batas_maks_hutang')->nullable();
            $table->string('batas_umur_hutang')->nullable();
            $table->string('mata_uang_pelanggan')->nullable();
            $table->string('saldo_awal_pelanggan')->nullable();
            $table->string('tanggal_pelanggan')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('alamatpajak_1')->nullable();
            $table->string('alamatpajak_2')->nullable();
            $table->string('negara')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kontak')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('memo')->nullable();
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
        Schema::dropIfExists('pelanggan');
    }
};
