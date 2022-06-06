<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->decimal('exchange_rate', '12', '6');
            $table->float('surcharge_percentage');
            $table->decimal('surcharge_amount', '12', '6');
            $table->decimal('amount_purchased', '12', '6');
            $table->decimal('amount_payed_usd', '12', '6');
            $table->float('discount_percentage');
            $table->decimal('discount_amount', '12', '6');
            $table->timestamps(); // NOTE: since we have "created_at" column as a timestamp, I did not put a dedicated "date" column

            // cascade deleting all related orders when it's currency is deleted, not sure how/if we defined this case
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
