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
        if(!Schema::hasTable('departments')) {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigInteger('departments_id')->autoIncrement();
            $table->bigInteger('deptcategoriesid');
            $table->text('departments_content');
            $table->text('departments_file');
            $table->text('departments_status');
            $table->date('departments_date');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
