<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkusTable extends Migration
{
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_sku')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
