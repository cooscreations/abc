<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryCurrencyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('country_currency', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id', 'currency_id_fk_3750950')->references('id')->on('currencies')->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_id_fk_3750950')->references('id')->on('countries')->onDelete('cascade');
        });
    }
}
