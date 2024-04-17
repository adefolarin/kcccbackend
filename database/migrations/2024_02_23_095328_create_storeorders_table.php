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
        if(!Schema::hasTable('storeorders')) {
            Schema::create('storeorders', function (Blueprint $table) {
                $table->bigInteger('storeorders_id')->autoIncrement();
                $table->bigInteger('storeusersid');
                $table->string('storeorders_refid');
                $table->decimal('storeorders_price',10,2);
                $table->bigInteger('storeorders_qty');
                $table->decimal('storeorders_total',10,2);
                $table->string('storeorders_currency');
                $table->string('storeorders_type');
                $table->string('storeorders_status');
                $table->string('logsname');
                $table->string('logspnum');
                $table->string('logsemail');
                $table->string('logsgender');
                $table->string('logslocation');
                $table->string('logsdelivery');
                $table->date('logsdate');
                $table->dateTime('storeorders_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storeorders');
    }
};
