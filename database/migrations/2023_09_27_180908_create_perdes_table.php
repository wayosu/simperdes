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
        Schema::create('perdes', function (Blueprint $table) {
            $table->id();
            $table->string('judul_peraturan');
            $table->foreignId('jenis_peraturan_id')->constraint('jenis_peraturans')->onDelete('cascade');
            $table->text('isi_peraturan');
            $table->string('file');
            $table->string('nama_penyusun');
            $table->foreignId('user_id')->constraint('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perdes');
    }
};
