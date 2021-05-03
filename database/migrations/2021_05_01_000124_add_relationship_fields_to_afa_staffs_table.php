<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAfaStaffsTable extends Migration
{
    public function up()
    {
        Schema::table('afa_staffs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3756867')->references('id')->on('users');
            $table->unsignedBigInteger('staff_level_id')->nullable();
            $table->foreign('staff_level_id', 'staff_level_fk_3756868')->references('id')->on('staff_levels');
            $table->unsignedBigInteger('reports_to_id')->nullable();
            $table->foreign('reports_to_id', 'reports_to_fk_3756869')->references('id')->on('users');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_fk_3757598')->references('id')->on('departments');
        });
    }
}
