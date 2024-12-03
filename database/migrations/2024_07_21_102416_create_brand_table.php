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
        Schema::create('brand', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('image')->nullable();
            $table->string('ext')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('brand');
    }
};
