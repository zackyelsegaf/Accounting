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
        Schema::create('penjual', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan_penjual')->nullable();
            $table->string('nama_belakang_penjual')->nullable();
            $table->string('jabatan')->nullable();
            $table->boolean('dihentikan')->nullable()->default(false);
            $table->string('no_kantor_1_penjual')->nullable();
            $table->string('no_kantor_2_penjual')->nullable();
            $table->string('no_ekstensi_1_penjual')->nullable();
            $table->string('no_ekstensi_2_penjual')->nullable();
            $table->string('no_hp_penjual')->nullable();
            $table->string('no_telp_penjual')->nullable();
            $table->string('no_fax_penjual')->nullable();
            $table->string('pager_penjual')->nullable();
            $table->string('email_penjual')->nullable();
            $table->string('memo')->nullable();
            $table->string('fileupload_1')->nullable();
            $table->string('fileupload_2')->nullable();
            $table->string('fileupload_3')->nullable();
            $table->string('fileupload_4')->nullable();
            $table->string('fileupload_5')->nullable();
            $table->string('fileupload_6')->nullable();
            $table->string('fileupload_7')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjual');
    }
};
