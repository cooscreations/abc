<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCodeGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('product_code_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('range_start')->nullable();
            $table->string('range_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
