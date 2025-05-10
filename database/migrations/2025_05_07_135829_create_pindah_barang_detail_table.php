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
        Schema::create('pindah_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pindah_barang_id')->constrained('pindah_barang')->onDelete('cascade');
            $table->string('no_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->string('kts_barang')->nullable();
            $table->string('satuan')->nullable();
            $table->string('pengguna_pindah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindah_barang_detail');
    }
};
