<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentPartsTable extends Migration
{
    public function up()
    {
        Schema::create('component_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->nullable();
            $table->boolean('has_fabric_finish_choice')->default(0)->nullable();
            $table->boolean('is_sub_assembly')->default(0)->nullable();
            $table->integer('length_mm')->nullable();
            $table->integer('width_mm')->nullable();
            $table->string('height_mm')->nullable();
            $table->integer('weight_g')->nullable();
            $table->boolean('is_optional')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
