<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYesNoMaybesTable extends Migration
{
    public function up()
    {
        Schema::create('yes_no_maybes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->string('default_css_class')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
