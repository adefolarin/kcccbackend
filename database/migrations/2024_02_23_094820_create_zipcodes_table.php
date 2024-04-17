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
        if(!Schema::hasTable('zipcodes')) {
            Schema::create('zipcodes', function (Blueprint $table) {
                $table->bigInteger('zipcodes_id')->autoIncrement();
                $table->string('zipcodes_name');
                $table->decimal('zipcodes_price',10,2);
                $table->date('zipcodes_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zipcodes');
    }
};
