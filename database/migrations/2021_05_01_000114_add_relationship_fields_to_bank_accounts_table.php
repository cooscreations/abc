<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3757445')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id', 'address_fk_3757446')->references('id')->on('addresses');
        });
    }
}
