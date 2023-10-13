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
        Schema::create('review_peraturan_desas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peraturan_desa_id')->constrained('peraturan_desas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->text('catatan')->nullable();
            $table->string('file')->nullable();
            $table->text('link_tautan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_peraturan_desas');
    }
};
