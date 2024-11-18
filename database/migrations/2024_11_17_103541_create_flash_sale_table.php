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
            $table->date('start_time'); // Waktu mulai flash sale
            $table->date('end_time'); // Waktu selesai flash sale
            $table->timestamps();
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
