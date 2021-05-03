<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedSizesByRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('bed_sizes_by_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('size_code');
            $table->longText('description')->nullable();
            $table->integer('mattress_w_mm')->nullable();
            $table->integer('mattress_l_mm')->nullable();
            $table->string('imperial_l_ft_in')->nullable();
            $table->string('imperial_w_ft_in')->nullable();
            $table->string('imperial_nickname')->nullable();
            $table->decimal('plank_approx_extra_usd', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
