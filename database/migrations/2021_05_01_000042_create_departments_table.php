<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('dept_code')->nullable();
            $table->string('hex_color')->nullable();
            $table->longText('dept_intro')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
