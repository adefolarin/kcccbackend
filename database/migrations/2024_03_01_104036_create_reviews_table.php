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
        if(!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->bigInteger('reviews_id')->autoIncrement();
                $table->year('reviews_year');
                $table->text('reviews_file');
                $table->date('reviews_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
