<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedSizeGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('bed_size_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('group_number');
            $table->boolean('is_ukfr')->default(0)->nullable();
            $table->integer('mattress_min_w_mm')->nullable();
            $table->integer('mattress_max_w_mm');
            $table->integer('mattress_min_l_mm');
            $table->integer('mattress_max_l_mm');
            $table->decimal('add_gl_approx_usd', 15, 2)->nullable();
            $table->decimal('add_pt_approx_usd', 15, 2)->nullable();
            $table->decimal('add_2_drawers_approx_usd', 15, 2)->nullable();
            $table->decimal('add_mailorder_pkg_approx_usd', 15, 2)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
