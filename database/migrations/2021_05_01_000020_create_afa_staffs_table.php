<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfaStaffsTable extends Migration
{
    public function up()
    {
        Schema::create('afa_staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name')->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_finished')->nullable();
            $table->longText('staff_bio')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
