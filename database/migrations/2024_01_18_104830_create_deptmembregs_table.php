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
        if(!Schema::hasTable('deptmembregs')) {
        Schema::create('deptmembregs', function (Blueprint $table) {
            $table->bigInteger('deptmembregs_id')->autoIncrement();
            $table->text('deptmembregs_name');
            $table->text('deptmembregs_email');
            $table->text('deptmembregs_pnum');
            $table->bigInteger('deptmembregs_dept');
            $table->date('deptmembregs_date');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptmembregs');
    }
};
