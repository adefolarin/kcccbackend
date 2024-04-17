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
        if(!Schema::hasTable('galleries')) {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigInteger('galleries_id')->autoIncrement();
            $table->bigInteger('gallerycategoriesid');
            $table->text('galleries_file');
            $table->date('galleries_date');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
