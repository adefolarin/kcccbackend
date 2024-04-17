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
        if(!Schema::hasTable('deptgalleries')) {
            Schema::create('deptgalleries', function (Blueprint $table) {
                $table->bigInteger('deptgalleries_id')->autoIncrement();
                $table->bigInteger('deptsid');
                $table->text('deptgalleries_file');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptgalleries');
    }
};
