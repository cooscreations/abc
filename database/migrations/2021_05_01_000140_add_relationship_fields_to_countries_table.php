<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCountriesTable extends Migration
{
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->unsignedBigInteger('world_region_id')->nullable();
            $table->foreign('world_region_id', 'world_region_fk_3750511')->references('id')->on('world_regions');
            $table->unsignedBigInteger('default_currency_id')->nullable();
            $table->foreign('default_currency_id', 'default_currency_fk_3750612')->references('id')->on('currencies');
        });
    }
}
