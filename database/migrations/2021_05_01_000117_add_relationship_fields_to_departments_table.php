<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id', 'manager_fk_3757438')->references('id')->on('users');
        });
    }
}
