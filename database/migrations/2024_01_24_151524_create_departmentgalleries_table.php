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
        if(!Schema::hasTable('departmentgalleries')) {
            Schema::create('departmentgalleries', function (Blueprint $table) {
                $table->bigInteger('departmentgalleries_id')->autoIncrement();
                $table->bigInteger('departmentsid');
                $table->text('departmentgalleries_file');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departmentgalleries');
    }
};
