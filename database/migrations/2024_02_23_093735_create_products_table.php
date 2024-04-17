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
        if(!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->bigInteger('products_id')->autoIncrement();
                $table->bigInteger('productcategoriesid');
                $table->string('products_name');
                $table->string('products_description');
                $table->decimal('products_price',10,2);
                $table->string('products_image');
                $table->bigInteger('products_likes')->nullable(true);
                $table->date('products_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
