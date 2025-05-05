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
        Schema::table('barang', function (Blueprint $table) {
            $table->string('satuan')->nullable();
            $table->string('rasio')->nullable();
            $table->string('level_harga_1')->nullable();
            $table->string('level_harga_2')->nullable();
            $table->string('level_harga_3')->nullable();
            $table->string('level_harga_4')->nullable();
            $table->string('level_harga_5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            //
        });
    }
};
