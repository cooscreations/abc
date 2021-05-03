<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorBedConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('visitor_bed_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('notes')->nullable();
            $table->string('public_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
