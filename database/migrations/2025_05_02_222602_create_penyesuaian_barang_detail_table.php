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
        Schema::create('penyesuaian_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyesuaian_barang_id')->constrained('penyesuaian_barang')->onDelete('cascade');
            $table->string('no_barang');
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_saat_ini')->nullable();
            $table->string('kts_baru')->nullable();
            $table->string('nilai_saat_ini')->nullable();
            $table->string('nilai_baru')->nullable();
            $table->string('departemen')->nullable();
            $table->string('proyek')->nullable();
            $table->string('gudang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyesuaian_barang_detail');
    }
};
