<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentPartNamesTable extends Migration
{
    public function up()
    {
        Schema::create('component_part_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
