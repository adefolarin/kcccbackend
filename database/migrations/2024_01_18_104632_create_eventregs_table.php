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
        if(!Schema::hasTable('eventregs')) {
        Schema::create('eventregs', function (Blueprint $table) {
            $table->bigInteger('eventregs_id')->autoIncrement();
            $table->text('eventregs_name');
            $table->text('eventregs_email');
            $table->text('eventregs_pnum');
            $table->bigInteger('eventregs_event');
            $table->date('eventregs_date');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventregs');
    }
};
