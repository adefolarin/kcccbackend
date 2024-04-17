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
        if(!Schema::hasTable('volunteers')) {
            Schema::create('volunteers', function (Blueprint $table) {
                $table->bigInteger('volunteers_id')->autoIncrement();
                $table->text('volunteers_type');
                $table->text('volunteers_name');
                $table->text('volunteers_email');
                $table->text('volunteers_pnum');
                $table->text('volunteers_time');
                $table->date('volunteers_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
