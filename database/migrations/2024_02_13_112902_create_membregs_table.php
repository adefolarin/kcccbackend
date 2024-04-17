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
        if(!Schema::hasTable('membregs')) {
            Schema::create('membregs', function (Blueprint $table) {
                $table->bigInteger('membregs_id')->autoIncrement();
                $table->text('membregs_name');
                $table->text('membregs_address');
                $table->text('membregs_email');
                $table->text('membregs_pnum');
                $table->text('membregs_gender');
                $table->text('membregs_maritalstatus');
                $table->date('membregs_dob');
                $table->text('membregs_how');
                $table->text('membregs_reason');
                $table->text('membregs_bornagain');
                $table->text('membregs_guidance');
                $table->text('membregs_request');
                $table->text('membregs_updated');
                $table->date('membregs_date');
                $table->timestamps();
            });
        }  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membregs');
    }
};
