<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('equipment_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qty')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
