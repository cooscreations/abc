<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedSizeGroupBedSizesByRegionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bed_size_group_bed_sizes_by_region', function (Blueprint $table) {
            $table->unsignedBigInteger('bed_sizes_by_region_id');
            $table->foreign('bed_sizes_by_region_id', 'bed_sizes_by_region_id_fk_3772369')->references('id')->on('bed_sizes_by_regions')->onDelete('cascade');
            $table->unsignedBigInteger('bed_size_group_id');
            $table->foreign('bed_size_group_id', 'bed_size_group_id_fk_3772369')->references('id')->on('bed_size_groups')->onDelete('cascade');
        });
    }
}
