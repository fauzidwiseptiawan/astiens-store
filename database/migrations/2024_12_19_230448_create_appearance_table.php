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
        Schema::create('appearance', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('site_name');
            $table->string('motto')->nullable(); // Motto atau slogan situs
            $table->string('color_base', 7)->nullable(); // Warna dasar situs (#hex)
            $table->string('hover_base', 7)->nullable(); // Warna hover dasar (#hex)
            $table->string('color_sec', 7)->nullable(); // Warna sekunder situs (#hex)
            $table->string('hover_sec', 7)->nullable(); // Warna hover sekunder (#hex)
            $table->string('meta_title')->nullable(); // Meta title untuk SEO
            $table->text('meta_desc')->nullable(); // Meta description untuk SEO
            $table->text('meta_key')->nullable(); // Kata kunci untuk SEO
            $table->text('cookies_txt')->nullable(); // Teks persetujuan cookies
            $table->string('icon')->nullable(); // URL ikon situs
            $table->string('ext');
            $table->string('size');
            $table->timestamp('created_at')->useCurrent();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('created_by')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('updated_by')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('deleted_by')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appearance');
    }
};
