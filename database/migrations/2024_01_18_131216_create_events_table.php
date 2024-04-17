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
        if(!Schema::hasTable('events')) {
        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('events_id')->autoIncrement();
            $table->bigInteger('eventcategoriesid');
            $table->text('events_title');
            $table->text('events_desc');
            $table->text('events_file');
            $table->dateTime('events_startdate');
            $table->dateTime('events_enddate');
            $table->text('events_venue');
            $table->text('events_address');
            $table->text('events_organizer');
            $table->text('events_preacher');
            $table->date('events_date');
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
