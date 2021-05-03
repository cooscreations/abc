<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCodeGroupStorageOptionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_code_group_storage_option', function (Blueprint $table) {
            $table->unsignedBigInteger('product_code_group_id');
            $table->foreign('product_code_group_id', 'product_code_group_id_fk_3772343')->references('id')->on('product_code_groups')->onDelete('cascade');
            $table->unsignedBigInteger('storage_option_id');
            $table->foreign('storage_option_id', 'storage_option_id_fk_3772343')->references('id')->on('storage_options')->onDelete('cascade');
        });
    }
}
