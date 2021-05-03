<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCodeGroupProductFunctionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_code_group_product_function', function (Blueprint $table) {
            $table->unsignedBigInteger('product_code_group_id');
            $table->foreign('product_code_group_id', 'product_code_group_id_fk_3765302')->references('id')->on('product_code_groups')->onDelete('cascade');
            $table->unsignedBigInteger('product_function_id');
            $table->foreign('product_function_id', 'product_function_id_fk_3765302')->references('id')->on('product_functions')->onDelete('cascade');
        });
    }
}
