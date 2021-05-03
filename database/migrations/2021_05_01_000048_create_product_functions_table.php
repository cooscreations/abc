<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFunctionsTable extends Migration
{
    public function up()
    {
        Schema::create('product_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('public_icon_url')->nullable();
            $table->integer('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
