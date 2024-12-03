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
            $table->enum('type_coupon', ['For Total Orders', 'Welcome Coupon']); // Tipe diskon (persentase atau nominal)
            $table->enum('type', ['Percentage', 'Flat']); // Tipe diskon (persentase atau nominal)
            $table->decimal('discount_amount', 8, 2); // Nilai diskon
            $table->decimal('min_purchase', 8, 2)->nullable(); // Pembelian minimum
            $table->decimal('max_discount', 8, 2)->nullable(); // Maksimum diskon (harga dalam IDR)
            $table->date('start_date'); // Waktu mulai flash sale
            $table->date('end_date'); // Waktu selesai flash sale
            $table->integer('usage_limit')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();

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
        Schema::dropIfExists('coupons');
    }
};
