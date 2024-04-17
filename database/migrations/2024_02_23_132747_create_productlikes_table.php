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
        if(!Schema::hasTable('productlikes')) {
            Schema::create('productlikes', function (Blueprint $table) {
                $table->bigInteger('productlikes_id')->autoIncrement();
                $table->bigInteger('storeusersid');
                $table->bigInteger('productsid');
                $table->string('productlikes_status');
                $table->date('productlikes_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productlikes');
    }
};
