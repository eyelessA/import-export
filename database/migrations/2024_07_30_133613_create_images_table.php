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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('public_path');
            $table->string('local_path')->nullable();

            $table->unsignedBigInteger('product_id');
            $table->index('product_id', 'image_product_id_index');
            $table->foreign('product_id', 'image_product_id_foreign')->on('products')->references('id');

            $table->timestamps();

            $table->unique(['product_id', 'public_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
