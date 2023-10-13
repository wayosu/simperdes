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
        Schema::create('tentang_kamis', function (Blueprint $table) {
            $table->id();
            $table->string('alamat')->nullable();
            $table->text('link_gmaps')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('link_facebook')->nullable();
            $table->text('link_instagram')->nullable();
            $table->text('link_twitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentang_kamis');
    }
};
