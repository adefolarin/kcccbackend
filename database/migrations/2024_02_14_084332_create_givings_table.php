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
        if(!Schema::hasTable('givings')) {
            Schema::create('givings', function (Blueprint $table) {
                $table->bigInteger('givings_id')->autoIncrement();
                $table->text('givings_name');
                $table->text('givings_email');
                $table->text('givings_pnum');
                $table->text('givings_type');
                $table->text('givings_reference');
                $table->decimal('givings_amount',10,2);
                $table->text('givings_status');
                $table->date('givings_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('givings');
    }
};
