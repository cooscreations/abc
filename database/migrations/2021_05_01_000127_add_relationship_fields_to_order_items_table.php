<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_fk_3756935')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3756937')->references('id')->on('products');
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->foreign('product_sku_id', 'product_sku_fk_3802179')->references('id')->on('product_skus');
        });
    }
}
