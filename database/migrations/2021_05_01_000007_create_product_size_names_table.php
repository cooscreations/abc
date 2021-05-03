<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizeNamesTable extends Migration
{
    public function up()
    {
        Schema::create('product_size_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->longText('description')->nullable();
            $table->integer('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
