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
        if(!Schema::hasTable('ratings')) {
            Schema::create('ratings', function (Blueprint $table) {
                $table->bigInteger('ratings_id')->autoIncrement();
                $table->bigInteger('productsid');
                $table->bigInteger('ratings_number');
                $table->string('ratings_comment');
                $table->bigInteger('ratings_status')->nullable(true);
                $table->dateTime('ratings_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
