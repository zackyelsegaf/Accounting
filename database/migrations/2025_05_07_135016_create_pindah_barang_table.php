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
        Schema::create('pindah_barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_pindah');
            $table->string('tgl_pindah')->nullable();
            $table->string('dari_gudang')->nullable();
            $table->string('ke_gudang')->nullable();
            $table->string('dari_alamat')->nullable();
            $table->string('ke_alamat')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('fileupload_1')->nullable();
            $table->string('fileupload_2')->nullable();
            $table->string('fileupload_3')->nullable();
            $table->string('fileupload_4')->nullable();
            $table->string('fileupload_5')->nullable();
            $table->string('fileupload_6')->nullable();
            $table->string('fileupload_7')->nullable();
            $table->string('fileupload_8')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindah_barang');
    }
};
