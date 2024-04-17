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
        if(!Schema::hasTable('donations')) {
            Schema::create('donations', function (Blueprint $table) {
                $table->bigInteger('donations_id')->autoIncrement();
                $table->text('donations_name');
                $table->text('donations_email');
                $table->text('donations_pnum');
                $table->text('donations_type');
                $table->text('donations_reference');
                $table->decimal('donations_amount',10,2);
                $table->text('donations_status');
                $table->date('donations_date');
                $table->timestamps();
            });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
