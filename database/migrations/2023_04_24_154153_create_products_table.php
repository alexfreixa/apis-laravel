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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_price')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('product_main_image')->nullable();
            $table->foreign('product_main_image')->references('id')->on('images')->onDelete('set null');

            $table->string('product_image_1')->nullable();
            $table->string('product_image_2')->nullable();
            $table->string('product_image_3')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_main_image']);
        });
        
        Schema::dropIfExists('products');
    }
};
