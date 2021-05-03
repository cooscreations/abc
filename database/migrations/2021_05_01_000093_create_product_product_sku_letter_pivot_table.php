<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductProductSkuLetterPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_product_sku_letter', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_3772366')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_sku_letter_id');
            $table->foreign('product_sku_letter_id', 'product_sku_letter_id_fk_3772366')->references('id')->on('product_sku_letters')->onDelete('cascade');
        });
    }
}
