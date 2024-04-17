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
        if(!Schema::hasTable('storeusers')) {
            Schema::create('storeusers', function (Blueprint $table) {
                $table->bigInteger('storeusers_id')->autoIncrement();
                $table->string('storeusers_fname');
                $table->string('storeusers_lname');
                $table->string('storeusers_gender');
                $table->string('storeusers_pnum');
                $table->string('storeusers_email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('storeusers_password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storeusers');
    }
};
