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
        Schema::create('product_variant_attributes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_variant_id')->nullable();
            $table->uuid('attributes_value_id')->nullable();
            $table->timestamps();

            $table->foreign('product_variant_id')
                ->references('id')
                ->on('product_variant')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('attributes_value_id')
                ->references('id')
                ->on('attributes_value')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attributes');
    }
};
