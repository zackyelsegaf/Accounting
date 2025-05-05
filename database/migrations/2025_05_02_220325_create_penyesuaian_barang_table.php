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
        Schema::create('penyesuaian_barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_penyesuaian')->nullable();
            $table->string('tgl_penyesuaian')->nullable();
            $table->string('akun_penyesuaian')->nullable();
            $table->string('deskripsi')->nullable();
            $table->boolean('nilai_penyesuaian_check')->nullable()->default(false);
            // $table->string('nilai_saat_ini')->nullable();
            // $table->string('nilai_baru')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyesuaian_barang');
    }
};
