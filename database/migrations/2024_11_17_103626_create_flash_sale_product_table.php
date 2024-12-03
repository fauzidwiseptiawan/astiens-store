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
        Schema::create('flash_sale_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('flash_sale_id');
            $table->uuid('product_id');
            $table->integer('discount_amount')->default(0)->nullable();
            $table->enum('discount_type', ['Flat', 'Percent']);
            $table->timestamps();

            $table->foreign('flash_sale_id')
                ->references('id')
                ->on('flash_sale')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_sale_product');
    }
};
