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
        Schema::create('proyek_umum', function (Blueprint $table) {
            $table->id();
            $table->string('proyek_umum_id');
            $table->string('nama_proyek')->nullable();
            $table->string('nama_kontak')->nullable();
            $table->string('tanggal_from')->nullable();
            $table->string('tanggal_to')->nullable();
            $table->string('persentase_komplet')->nullable();
            $table->boolean('persentase_komplet_check')->nullable()->default(false);
            $table->string('deskripsi')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->string('total_pendapatan')->nullable();
            $table->string('total_pendapatan_from')->nullable();
            $table->string('total_biaya')->nullable();
            $table->string('total_biaya_from')->nullable();
            $table->string('total_beban')->nullable();
            $table->string('total_beban_from')->nullable();
            $table->string('laba_rugi')->nullable();
            $table->string('laba_rugi_from')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_umum');
    }
};
