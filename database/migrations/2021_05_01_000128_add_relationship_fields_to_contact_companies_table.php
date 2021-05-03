<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('contact_companies', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_company_id')->nullable();
            $table->foreign('parent_company_id', 'parent_company_fk_3802421')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('primary_company_type_id')->nullable();
            $table->foreign('primary_company_type_id', 'primary_company_type_fk_3756408')->references('id')->on('company_types');
            $table->unsignedBigInteger('reg_country_id')->nullable();
            $table->foreign('reg_country_id', 'reg_country_fk_3756409')->references('id')->on('countries');
            $table->unsignedBigInteger('owner_contact_id')->nullable();
            $table->foreign('owner_contact_id', 'owner_contact_fk_3756789')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('ownership_type_id')->nullable();
            $table->foreign('ownership_type_id', 'ownership_type_fk_3756797')->references('id')->on('company_ownership_types');
            $table->unsignedBigInteger('primary_language_id')->nullable();
            $table->foreign('primary_language_id', 'primary_language_fk_3809239')->references('id')->on('languages');
        });
    }
}
