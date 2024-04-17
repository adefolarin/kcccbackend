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
        if(!Schema::hasTable('sermoncategories')) {
        Schema::create('sermoncategories', function (Blueprint $table) {
            $table->bigInteger('sermoncategories_id')->autoIncrement();
            $table->text('sermoncategories_name');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sermoncategories');
    }
};
