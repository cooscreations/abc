<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('is_vegan')->default(0)->nullable();
            $table->boolean('is_sustainable')->default(0)->nullable();
            $table->boolean('is_ukfr_std')->default(0)->nullable();
            $table->boolean('is_ukfr_treatable')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
