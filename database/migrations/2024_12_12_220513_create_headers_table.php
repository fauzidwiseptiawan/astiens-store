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
        Schema::create('headers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('title_promo');  // Menambahkan kolom title_promo dengan tipe data JSON
            $table->text('image');
            $table->string('ext');
            $table->string('size');
            $table->json('nav_menu');  // Menambahkan kolom title_promo dengan tipe data JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
