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
        if(!Schema::hasTable('volforms')) {
        Schema::create('volforms', function (Blueprint $table) {
            $table->bigInteger('volforms_id')->autoIncrement();
            $table->bigInteger('volcategoriesid');
            $table->dateTime('voldatetime');
            $table->timestamps();
        });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volforms');
    }
};
