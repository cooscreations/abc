<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('add_line_1')->nullable();
            $table->string('add_line_2')->nullable();
            $table->string('add_line_3')->nullable();
            $table->string('city')->nullable();
            $table->boolean('is_billing_address')->default(0)->nullable();
            $table->boolean('is_shipping_address')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
