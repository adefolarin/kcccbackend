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
        if(!Schema::hasTable('podcastcategories')) {
        Schema::create('podcastcategories', function (Blueprint $table) {
            $table->bigInteger('podcastcategories_id')->autoIncrement();
            $table->text('podcastcategories_name');
            $table->timestamps();
        });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcastcategories');
    }
};
