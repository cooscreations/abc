<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('public_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
