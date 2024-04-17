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
        if(!Schema::hasTable('news')) {
        Schema::create('news', function (Blueprint $table) {
            $table->bigInteger('news_id')->autoIncrement();
            $table->bigInteger('newscategoriesid');
            $table->text('news_title');
            $table->text('news_file');
            $table->text('news_content');
            $table->date('news_date');
            $table->timestamps();
        });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
