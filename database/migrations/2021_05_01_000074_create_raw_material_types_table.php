<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialTypesTable extends Migration
{
    public function up()
    {
        Schema::create('raw_material_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->string('public_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
