<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('short_code')->nullable();
            $table->string('alpha_2')->nullable();
            $table->string('alpha_3')->nullable();
            $table->longText('notes')->nullable();
            $table->string('wiki_url')->nullable();
            $table->string('iso_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
