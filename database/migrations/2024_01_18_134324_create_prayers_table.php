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
        if(!Schema::hasTable('prayers')) {
        Schema::create('prayers', function (Blueprint $table) {
            $table->bigInteger('prayers_id')->autoIncrement();
            $table->text('prayeruser_name');
            $table->text('prayeruser_email');
            $table->text('prayeruser_pnum');
            $table->text('prayeruser_request');
            $table->date('prayers_date');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayers');
    }
};
