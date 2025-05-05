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
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->string('no_akun')->nullable();
            $table->string('nama_akun_indonesia')->nullable();
            $table->string('nama_akun_inggris')->nullable();
            $table->string('mata_uang')->nullable();
            $table->boolean('sub_akun_check')->nullable()->default(false);
            $table->string('sub_akun')->nullable();
            $table->string('saldo_akun')->nullable();
            $table->string('tanggal')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
