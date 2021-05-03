<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToComponentPartsTable extends Migration
{
    public function up()
    {
        Schema::table('component_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->foreign('product_sku_id', 'product_sku_fk_3772478')->references('id')->on('product_skus');
            $table->unsignedBigInteger('component_part_name_id')->nullable();
            $table->foreign('component_part_name_id', 'component_part_name_fk_3772479')->references('id')->on('component_part_names');
            $table->unsignedBigInteger('raw_material_id')->nullable();
            $table->foreign('raw_material_id', 'raw_material_fk_3772483')->references('id')->on('raw_materials');
            $table->unsignedBigInteger('default_product_group_id')->nullable();
            $table->foreign('default_product_group_id', 'default_product_group_fk_3772490')->references('id')->on('product_groups');
        });
    }
}
