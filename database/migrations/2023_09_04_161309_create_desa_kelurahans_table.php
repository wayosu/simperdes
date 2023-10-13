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
        Schema::create('desa_kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('nama_kepala_desa');
            $table->foreignId('kecamatan_id')->constraint('kecamatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa_kelurahans');
    }
};
