<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricPriceBandsTable extends Migration
{
    public function up()
    {
        Schema::create('fabric_price_bands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('band_letter')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('cny_start_price', 15, 2);
            $table->decimal('cny_finish_price', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
