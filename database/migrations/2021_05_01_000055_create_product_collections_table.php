<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCollectionsTable extends Migration
{
    public function up()
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('public_logo_url')->nullable();
            $table->string('public_url')->nullable();
            $table->string('share_point_url')->nullable();
            $table->integer('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
