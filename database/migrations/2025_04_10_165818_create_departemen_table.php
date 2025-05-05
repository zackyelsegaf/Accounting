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
        Schema::create('departemen', function (Blueprint $table) {
            $table->id();
            $table->string('departemen_id');
            $table->string('nama_departemen')->nullable();
            $table->string('nama_kontak')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('tipe_departemen')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departemen');
    }
};
