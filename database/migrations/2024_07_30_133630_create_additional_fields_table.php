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
        Schema::create('additional_fields', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('composition')->nullable();
            $table->integer('quantity_per_pack')->nullable();
            $table->string('pack_link')->nullable();
            $table->text('photo_links')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_h1')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('product_weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->integer('package_weight')->nullable();
            $table->integer('package_width')->nullable();
            $table->integer('package_height')->nullable();
            $table->integer('package_length')->nullable();
            $table->string('product_category')->nullable();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->index('product_id', 'additional_fields_product_id_index');
            $table->foreign('product_id', 'additional_fields_product_id_foreign')->on('products')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_fields');
    }
};
