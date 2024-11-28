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
        Schema::create('flash_sale', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID sebagai primary key
            $table->string('name'); // Nama flash sale
            $table->string('slug'); // Nama flash sale
            $table->dateTime('start_date'); // Waktu mulai flash sale
            $table->dateTime('end_date'); // Waktu selesai flash sale
            $table->text('image')->nullable();
            $table->string('ext')->nullable();
            $table->string('size')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('is_feature')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_sale');
    }
};
