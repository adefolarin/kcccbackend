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
        if(!Schema::hasTable('banners')) {
            Schema::create('banners', function (Blueprint $table) {
                $table->bigInteger('banner_id')->autoIncrement();
                $table->text('banner_type');
                $table->text('banner_name');
                $table->text('banner_desc')->nullable();
                $table->text('banner_file');
                $table->date('banner_date');
                //$table->timestamps();
            });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
