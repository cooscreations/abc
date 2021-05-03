<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTypesTable extends Migration
{
    public function up()
    {
        Schema::create('company_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('notes')->nullable();
            $table->integer('list_order')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
