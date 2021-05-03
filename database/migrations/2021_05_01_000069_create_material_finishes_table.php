<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialFinishesTable extends Migration
{
    public function up()
    {
        Schema::create('material_finishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
