<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorldRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('world_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('notes')->nullable();
            $table->string('wiki_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
