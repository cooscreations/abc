<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawerConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('drawer_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('notes')->nullable();
            $table->string('public_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
