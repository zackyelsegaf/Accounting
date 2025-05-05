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
            $table->text('kode_pos')->nullable()->after('status');
            $table->text('provinsi')->nullable()->after('kode_pos');
            $table->text('kota')->nullable()->after('provinsi');
            $table->text('negara')->nullable()->after('kota');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasok', function (Blueprint $table) {
            $table->dropColumn(['kode_pos', 'provinsi', 'kota','negara']);
        });
    }
};
