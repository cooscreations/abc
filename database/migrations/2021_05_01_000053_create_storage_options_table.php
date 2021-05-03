<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('storage_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('notes')->nullable();
            $table->string('public_url')->nullable();
            $table->integer('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
