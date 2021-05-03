<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCodeGroupProductTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_code_group_product_type', function (Blueprint $table) {
            $table->unsignedBigInteger('product_code_group_id');
            $table->foreign('product_code_group_id', 'product_code_group_id_fk_3772342')->references('id')->on('product_code_groups')->onDelete('cascade');
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id', 'product_type_id_fk_3772342')->references('id')->on('product_types')->onDelete('cascade');
        });
    }
}
