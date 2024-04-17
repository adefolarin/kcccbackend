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
        if(!Schema::hasTable('devicetokens')) {
        Schema::create('devicetokens', function (Blueprint $table) {
            $table->bigInteger('devicetokens_id')->autoIncrement();
            $table->mediumText('tokens_id');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devicetokens');
    }
};
