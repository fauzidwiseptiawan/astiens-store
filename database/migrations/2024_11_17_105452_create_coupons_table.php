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
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'flat'])->default('percentage'); // Tipe diskon (persentase atau nominal)
            $table->decimal('value', 8, 2); // Nilai diskon
            $table->decimal('min_purchase', 8, 2)->nullable(); // Pembelian minimum
            $table->timestamp('expires_at')->nullable(); // Tanggal kadaluarsa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
