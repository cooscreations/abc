<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkuLettersTable extends Migration
{
    public function up()
    {
        Schema::create('product_sku_letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('letter_code');
            $table->string('full_name');
            $table->string('description')->nullable();
            $table->string('sharepoint_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
