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
        Schema::create('syarat', function (Blueprint $table) {
            $table->id();
            $table->string('batas_hutang');
            $table->boolean('cash_on_delivery')->default(false);
            $table->string('persentase_diskon');
            $table->string('periode_diskon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat');
    }
};
