<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('price_list_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
