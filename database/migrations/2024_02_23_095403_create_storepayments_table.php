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
        if(!Schema::hasTable('storepayments')) {
            Schema::create('storepayments', function (Blueprint $table) {
                $table->bigInteger('storepayments_id')->autoIncrement();
                $table->string('storepayments_refid');
                $table->decimal('storepayments_amount',10,2);
                $table->string('storepayments_currency');
                $table->string('storepayments_type');
                $table->string('storepayments_status');
                $table->date('storepayments_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storepayments');
    }
};
