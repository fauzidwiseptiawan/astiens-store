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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slider_groups_id');
            $table->string('title_h4')->nullable();
            $table->string('subtitle_h2')->nullable();
            $table->string('main_heading_h1')->nullable();
            $table->string('description_p')->nullable();
            $table->string('link_url')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->text('image')->nullable();
            $table->string('ext')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();

            $table->foreign('slider_groups_id')
                ->references('id')
                ->on('slider_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_items');
    }
};
