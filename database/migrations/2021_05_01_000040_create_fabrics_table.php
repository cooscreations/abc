<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricsTable extends Migration
{
    public function up()
    {
        Schema::create('fabrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fabric_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
