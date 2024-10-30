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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->uuid('sub_category_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('name')->nullable();
            $table->string('slugs')->nullable();
            $table->string('unit')->nullable();
            $table->integer('min_qty')->nullable();
            $table->integer('max_qty')->nullable();
            $table->string('barcode')->nullable();
            $table->text('image')->nullable();
            $table->string('ext')->nullable();
            $table->string('size')->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->string('sku')->nullable();
            $table->string('stock')->nullable();
            $table->date('discount_start_date')->nullable(); // Tanggal mulai diskon
            $table->date('discount_end_date')->nullable();  // Tanggal berakhir diskon
            $table->decimal('discount', 5, 2)->nullable(); // Nilai diskon, contoh: 10.50%
            $table->longText('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->text('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_desc')->nullable();
            $table->enum('new_arrival', [0, 1])->default(0);
            $table->enum('best_seller', [0, 1])->default(0);
            $table->enum('special_offer', [0, 1])->default(0);
            $table->enum('hot', [0, 1])->default(0);
            $table->enum('new', [0, 1])->default(0);
            $table->enum('sale', [0, 1])->default(0);
            $table->enum('is_active', [0, 1])->default(1);
            $table->enum('is_deleted', [0, 1])->default(0);
            $table->enum('is_variant', [0, 1])->default(0);
            $table->enum('is_feature', [0, 1])->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_category')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brand')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
