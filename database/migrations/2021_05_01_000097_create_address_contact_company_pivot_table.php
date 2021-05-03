<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressContactCompanyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('address_contact_company', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_company_id');
            $table->foreign('contact_company_id', 'contact_company_id_fk_3809240')->references('id')->on('contact_companies')->onDelete('cascade');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id', 'address_id_fk_3809240')->references('id')->on('addresses')->onDelete('cascade');
        });
    }
}
