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
        if(!Schema::hasTable('eventgalleries')) {
            Schema::create('eventgalleries', function (Blueprint $table) {
                $table->bigInteger('eventgalleries_id')->autoIncrement();
                $table->bigInteger('eventsid');
                $table->text('eventgalleries_file');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventgalleries');
    }
};
