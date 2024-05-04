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
        if(!Schema::hasTable('podcasts')) {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->bigInteger('podcasts_id')->autoIncrement();
            $table->bigInteger('podcastcategoriesid');
            $table->text('podcasts_title');
            $table->text('podcasts_file');
            $table->text('podcasts_filetype');
            $table->date('podcasts_date');
            $table->text('podcasts_location')->nullable(true);
            $table->text('podcasts_preacher')->nullable(true);
            $table->text('podcasts_likes')->nullable(true);
            $table->text('podcasts_shares')->nullable(true);
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcastss');
    }
};
