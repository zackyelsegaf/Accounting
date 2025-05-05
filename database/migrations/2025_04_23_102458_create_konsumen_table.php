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
        Schema::create('konsumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konsumen')->nullable();
            $table->string('nik_konsumen')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('status_pengajuan')->nullable();
            $table->string('cluster')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('alamat_konsumen')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('marketing')->nullable();
            $table->string('nik_pasangan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('no_hp_pasangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumen');
    }
};
