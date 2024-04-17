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
        if(!Schema::hasTable('volcategories')) {
        Schema::create('volcategories', function (Blueprint $table) {
            $table->bigInteger('volcategories_id')->autoIncrement();
            $table->text('volcategories_name');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volcategories');
    }
};
