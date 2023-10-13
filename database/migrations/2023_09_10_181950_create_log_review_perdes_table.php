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
        Schema::create('log_peraturan_desas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peraturan_desa_id')->constraint('peraturan_desas')->onDelete('cascade');
            $table->string('judul_peraturan');
            $table->foreignId('jenis_peraturan_id')->constraint('jenis_peraturans')->onDelete('cascade');
            $table->text('isi_peraturan');
            $table->string('file');
            $table->string('nama_penyusun');
            $table->foreignId('user_id')->constraint('users')->onDelete('cascade');
            // status
            // 0 = belum diperiksa
            // 1 = sedang diperiksa
            // 2 = selesai diperiksa
            // 3 = evaluasi
            // 4 = selesai
            $table->tinyInteger('status_admin_kabkota')->default(0);
            $table->tinyInteger('status_admin_kecamatan')->default(0);
            $table->tinyInteger('status_admin_mitra')->default(0);
            $table->foreignId('admin_kabkota_id')->constraint('users')->onDelete('cascade')->default(NULL);
            $table->foreignId('admin_kecamatan_id')->constraint('users')->onDelete('cascade')->default(NULL);
            $table->foreignId('admin_mitra_id')->constraint('users')->onDelete('cascade')->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_peraturan_desas');
    }
};
