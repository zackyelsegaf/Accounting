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
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->string('tanggal_lahir')->nullable()->after('nik_pelanggan');
            $table->string('tempat_lahir')->nullable()->after('tanggal_lahir');
            $table->string('agama')->nullable()->after('tempat_lahir');
            $table->string('nama_ayah')->nullable()->after('agama');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            //
        });
    }
};
