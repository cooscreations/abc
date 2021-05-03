<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingsTable extends Migration
{
    public function up()
    {
        Schema::create('packagings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
