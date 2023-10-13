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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->default(0);
            /* 
                Users: 
                0=>Mitra, 
                1=>Admin Desa Kelurahan, 
                2=>Admin Kecamatan, 
                3=>Admin Pemda Kabupaten Kota,
                4=>Super Admin
            */
            $table->string('nomor_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('kabupaten_kota_id')->nullable()->constraint('kabupaten_kotas');
            $table->foreignId('kecamatan_id')->nullable()->constraint('kecamatan');
            $table->foreignId('desa_kelurahan_id')->nullable()->constraint('desa_kelurahans');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
