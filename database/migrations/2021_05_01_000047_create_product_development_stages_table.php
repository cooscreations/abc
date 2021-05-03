<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDevelopmentStagesTable extends Migration
{
    public function up()
    {
        Schema::create('product_development_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('list_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
