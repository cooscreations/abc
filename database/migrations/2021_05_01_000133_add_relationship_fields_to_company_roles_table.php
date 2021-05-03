<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompanyRolesTable extends Migration
{
    public function up()
    {
        Schema::table('company_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3757018')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_3757019')->references('id')->on('roles');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id', 'contact_fk_3757020')->references('id')->on('contact_contacts');
        });
    }
}
