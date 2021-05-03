<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('inspection_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('list_order')->nullable();
            $table->string('status_color_hex')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
