<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBedSizesByRegionsTable extends Migration
{
    public function up()
    {
        Schema::table('bed_sizes_by_regions', function (Blueprint $table) {
            $table->unsignedBigInteger('world_region_id');
            $table->foreign('world_region_id', 'world_region_fk_3757553')->references('id')->on('world_regions');
            $table->unsignedBigInteger('size_name_id')->nullable();
            $table->foreign('size_name_id', 'size_name_fk_3757554')->references('id')->on('product_size_names');
            $table->unsignedBigInteger('base_style_id')->nullable();
            $table->foreign('base_style_id', 'base_style_fk_3757559')->references('id')->on('base_styles');
        });
    }
}
