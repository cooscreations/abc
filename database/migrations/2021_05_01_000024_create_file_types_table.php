<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTypesTable extends Migration
{
    public function up()
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('hex_color_code')->nullable();
            $table->longText('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
