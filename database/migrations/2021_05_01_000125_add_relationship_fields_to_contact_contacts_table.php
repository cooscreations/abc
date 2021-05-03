<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3756790')->references('id')->on('users');
            $table->unsignedBigInteger('country_of_birth_id')->nullable();
            $table->foreign('country_of_birth_id', 'country_of_birth_fk_3772379')->references('id')->on('countries');
            $table->unsignedBigInteger('primary_address_id')->nullable();
            $table->foreign('primary_address_id', 'primary_address_fk_3772380')->references('id')->on('addresses');
            $table->unsignedBigInteger('current_country_id')->nullable();
            $table->foreign('current_country_id', 'current_country_fk_3772381')->references('id')->on('countries');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3752516')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('default_language_id')->nullable();
            $table->foreign('default_language_id', 'default_language_fk_3772393')->references('id')->on('languages');
        });
    }
}
