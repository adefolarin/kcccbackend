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
        if(!Schema::hasTable('donationcategories')) {
            Schema::create('donationcategories', function (Blueprint $table) {
                $table->bigInteger('donationcategories_id')->autoIncrement();
                $table->text('donationcategories_name')->unique();
                $table->timestamps();
            });
          }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donationcategories');
    }
};
