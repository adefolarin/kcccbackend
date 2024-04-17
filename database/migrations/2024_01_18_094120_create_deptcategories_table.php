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
        if(!Schema::hasTable('deptcategories')) {
        Schema::create('deptcategories', function (Blueprint $table) {
            $table->bigInteger('deptcategories_id')->autoIncrement();
            $table->text('deptcategories_name');
            $table->timestamps();
        });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptcategories');
    }
};
