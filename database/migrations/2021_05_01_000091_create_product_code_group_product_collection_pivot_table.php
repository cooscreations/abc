<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCodeGroupProductCollectionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_code_group_product_collection', function (Blueprint $table) {
            $table->unsignedBigInteger('product_code_group_id');
            $table->foreign('product_code_group_id', 'product_code_group_id_fk_3765301')->references('id')->on('product_code_groups')->onDelete('cascade');
            $table->unsignedBigInteger('product_collection_id');
            $table->foreign('product_collection_id', 'product_collection_id_fk_3765301')->references('id')->on('product_collections')->onDelete('cascade');
        });
    }
}
