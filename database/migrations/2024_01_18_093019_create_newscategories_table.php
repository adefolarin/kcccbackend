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
        if(!Schema::hasTable('newscategories')) {
        Schema::create('newscategories', function (Blueprint $table) {
            $table->bigInteger('newscategories_id')->autoIncrement();
            $table->text('newscategories_name');
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newscategories');
    }
};
