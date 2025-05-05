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
        Schema::table('penyesuaian_barang', function (Blueprint $table) {
            $table->boolean('catatan_pemeriksaan_check')->nullable()->default(false);
            $table->boolean('tindak_lanjut_check')->nullable()->default(false);
            $table->boolean('disetujui_check')->nullable()->default(false);
            $table->boolean('urgensi_check')->nullable()->default(false);
            $table->string('nilai_penyesuaian')->nullable();
            $table->string('total_nilai_penyesuaian')->nullable();
            $table->string('pengguna_penyesuaian')->nullable();
            $table->string('no_persetujuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyesuaian_barang', function (Blueprint $table) {
            //
        });
    }
};
