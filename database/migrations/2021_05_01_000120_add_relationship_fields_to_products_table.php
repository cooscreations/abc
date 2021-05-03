<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('primary_nickname_id')->nullable();
            $table->foreign('primary_nickname_id', 'primary_nickname_fk_3772453')->references('id')->on('product_nicknames');
            $table->unsignedBigInteger('product_code_group_id')->nullable();
            $table->foreign('product_code_group_id', 'product_code_group_fk_3772454')->references('id')->on('product_code_groups');
            $table->unsignedBigInteger('default_function_id')->nullable();
            $table->foreign('default_function_id', 'default_function_fk_3757548')->references('id')->on('product_functions');
            $table->unsignedBigInteger('product_collection_id')->nullable();
            $table->foreign('product_collection_id', 'product_collection_fk_3772455')->references('id')->on('product_collections');
            $table->unsignedBigInteger('default_group_id')->nullable();
            $table->foreign('default_group_id', 'default_group_fk_3757549')->references('id')->on('product_groups');
            $table->unsignedBigInteger('default_storage_id')->nullable();
            $table->foreign('default_storage_id', 'default_storage_fk_3756510')->references('id')->on('storage_options');
            $table->unsignedBigInteger('default_gas_lift_config_id')->nullable();
            $table->foreign('default_gas_lift_config_id', 'default_gas_lift_config_fk_3772456')->references('id')->on('gas_lift_configs');
            $table->unsignedBigInteger('default_drawer_config_id')->nullable();
            $table->foreign('default_drawer_config_id', 'default_drawer_config_fk_3756512')->references('id')->on('drawer_configs');
            $table->unsignedBigInteger('default_drawer_movement_id')->nullable();
            $table->foreign('default_drawer_movement_id', 'default_drawer_movement_fk_3756990')->references('id')->on('drawer_movements');
            $table->unsignedBigInteger('default_tv_config_id')->nullable();
            $table->foreign('default_tv_config_id', 'default_tv_config_fk_3756511')->references('id')->on('tv_bed_configs');
            $table->unsignedBigInteger('default_visitor_config_id')->nullable();
            $table->foreign('default_visitor_config_id', 'default_visitor_config_fk_3756513')->references('id')->on('visitor_bed_configs');
            $table->unsignedBigInteger('primary_material_id')->nullable();
            $table->foreign('primary_material_id', 'primary_material_fk_3772457')->references('id')->on('raw_materials');
            $table->unsignedBigInteger('std_packaging_id')->nullable();
            $table->foreign('std_packaging_id', 'std_packaging_fk_3772462')->references('id')->on('packagings');
        });
    }
}
