<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductSkusTable extends Migration
{
    public function up()
    {
        Schema::table('product_skus', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3756930')->references('id')->on('products');
            $table->unsignedBigInteger('prod_dev_stage_id')->nullable();
            $table->foreign('prod_dev_stage_id', 'prod_dev_stage_fk_3757265')->references('id')->on('product_development_stages');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id', 'size_fk_3757558')->references('id')->on('bed_sizes_by_regions');
        });
    }
}
