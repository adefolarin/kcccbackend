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
        if(!Schema::hasTable('foodbanks')) {
            Schema::create('foodbanks', function (Blueprint $table) {
                $table->bigInteger('foodbanks_id')->autoIncrement();
                $table->bigInteger('foodbankcategoriesid');
                $table->text('foodbanks_videofile')->nullable();
                $table->text('foodbanks_imagefile')->nullable();
                $table->date('foodbanks_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodbanks');
    }
};
