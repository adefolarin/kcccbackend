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
        if(!Schema::hasTable('prodlikes')) {
            Schema::create('prodlikes', function (Blueprint $table) {
                $table->bigInteger('prodlikes_id')->autoIncrement();
                $table->bigInteger('storeusersid');
                $table->bigInteger('productsid');
                $table->string('prodlikes_status');
                $table->date('prodlikes_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodlikes');
    }
};
