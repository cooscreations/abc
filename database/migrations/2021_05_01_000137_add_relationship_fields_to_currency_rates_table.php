<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCurrencyRatesTable extends Migration
{
    public function up()
    {
        Schema::table('currency_rates', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_3750992')->references('id')->on('currencies');
        });
    }
}
