<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('staff_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
