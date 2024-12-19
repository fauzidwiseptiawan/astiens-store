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
        Schema::create('footers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('address');
            $table->string('phone');
            $table->enum('show_link', ['No', 'Yes'])->default('Yes');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('pinterest');
            $table->enum('show_store', ['No', 'Yes'])->default('Yes');
            $table->string('app_store');
            $table->string('play_store');
            $table->text('image1');
            $table->string('ext1');
            $table->string('size1');
            $table->text('image2');
            $table->string('ext2');
            $table->string('size2');
            $table->json('link_menu');  // Menambahkan kolom title_promo dengan tipe data JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
