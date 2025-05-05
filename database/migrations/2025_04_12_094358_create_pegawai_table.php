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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nik_pegawai')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('tempat_lahir_pegawai')->nullable();
            $table->string('tanggal_lahir_pegawai')->nullable();
            $table->string('jenis_kelamin_pegawai')->nullable();
            $table->string('agama_pegawai')->nullable();
            $table->string('status_pernikahan_pegawai')->nullable();
            $table->string('golongan_darah_pegawai')->nullable();
            $table->string('email_pegawai')->nullable();
            $table->string('no_telp_pegawai')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rt_pegawai')->nullable();
            $table->string('rw_pegawai')->nullable();
            $table->string('alamat_pegawai')->nullable();
            $table->string('nama_bank_pegawai')->nullable();
            $table->string('nomor_rekening_pegawai')->nullable();
            $table->string('atas_nama_pegawai')->nullable();
            $table->string('jenis_identitas_pegawai')->nullable();
            $table->string('nomor_identitas_pegawai')->nullable();
            $table->string('nama_ayah_pegawai')->nullable();
            $table->string('nama_ibu_pegawai')->nullable();
            $table->string('nama_kontak_darurat_pegawai')->nullable();
            $table->string('no_telp_darurat_pegawai')->nullable();
            $table->string('hubungan_pegawai')->nullable();
            $table->string('status_pekerjaan_pegawai')->nullable();
            $table->string('foto_pegawai')->nullable();
            $table->string('tanggal_masuk_pegawai')->nullable();
            $table->string('tanggal_keluar_pegawai')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
