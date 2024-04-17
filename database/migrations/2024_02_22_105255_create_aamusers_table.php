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
        if(!Schema::hasTable('aamusers')) {
            Schema::create('aamusers', function (Blueprint $table) {
                $table->bigInteger('aamusers_id')->autoIncrement();
                $table->text('aamusers_name');
                $table->text('aamusers_email')->unique();
                $table->text('aamusers_pnum')->nullable();
                $table->text('aamusers_address')->nullable();
                $table->text('aamusers_country')->nullable();
                $table->text('aamusers_state')->nullable();
                $table->text('aamusers_city')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('aamusers_password');
                $table->text('aamusers_code')->nullable();
                $table->datetime('aamusers_resetdate')->nullable();
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
        Schema::dropIfExists('aamusers');
    }
};
