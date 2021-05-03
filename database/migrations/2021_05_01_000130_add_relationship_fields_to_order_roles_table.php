<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderRolesTable extends Migration
{
    public function up()
    {
        Schema::table('order_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_3756995')->references('id')->on('orders');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_3756996')->references('id')->on('roles');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id', 'contact_fk_3756997')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3756998')->references('id')->on('users');
        });
    }
}
