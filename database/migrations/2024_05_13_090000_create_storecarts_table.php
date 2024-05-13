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
        if(!Schema::hasTable('storecarts')) {
            Schema::create('storecarts', function (Blueprint $table) {
                $table->bigInteger('storecarts_id')->autoIncrement();
                $table->bigInteger('storeusersid');
                $table->bigInteger('storeproductsid');
                $table->bigInteger('storecarts_qty');
                $table->decimal('storeproductsprice',10,2);
                $table->decimal('storecarts_totalprice',10,2);
                $table->date('storecarts_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storecarts');
    }
};
