<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contact_role', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_3772495')->references('id')->on('contact_contacts')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_3772495')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
