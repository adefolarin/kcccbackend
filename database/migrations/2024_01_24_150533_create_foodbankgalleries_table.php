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
        if(!Schema::hasTable('foodbankgalleries')) {
            Schema::create('foodbankgalleries', function (Blueprint $table) {
                $table->bigInteger('foodbankgalleries_id')->autoIncrement();
                $table->bigInteger('foodbanksid');
                $table->text('foodbankgalleries_file');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodbankgalleries');
    }
};
