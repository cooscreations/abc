<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyRatesTable extends Migration
{
    public function up()
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('usd_value', 15, 2);
            $table->date('valid_until')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
