<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('alpha_2')->nullable();
            $table->string('local_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
