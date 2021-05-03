<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPricesTable extends Migration
{
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->unsignedBigInteger('sku_id');
            $table->foreign('sku_id', 'sku_fk_3757417')->references('id')->on('product_skus');
            $table->unsignedBigInteger('default_raw_material_id')->nullable();
            $table->foreign('default_raw_material_id', 'default_raw_material_fk_3757418')->references('id')->on('raw_materials');
            $table->unsignedBigInteger('price_list_id')->nullable();
            $table->foreign('price_list_id', 'price_list_fk_3757419')->references('id')->on('price_lists');
        });
    }
}
