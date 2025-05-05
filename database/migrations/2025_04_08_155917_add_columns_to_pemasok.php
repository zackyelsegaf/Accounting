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
        Schema::table('pemasok', function (Blueprint $table) {
            $table->string('npwp')->nullable()->after('dihentikan');
            $table->string('pajak_1')->nullable()->after('npwp');
            $table->string('pajak_2')->nullable()->after('pajak_1');
            $table->string('syarat')->nullable()->after('pajak_2');
            $table->string('mata_uang')->nullable()->after('syarat');
            $table->string('saldo_awal')->nullable()->after('mata_uang');
            $table->string('tanggal')->nullable()->after('saldo_awal');
            $table->string('deskripsi')->nullable()->after('tanggal');
            $table->string('no_pkp')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasok', function (Blueprint $table) {
            //
        });
    }
};
