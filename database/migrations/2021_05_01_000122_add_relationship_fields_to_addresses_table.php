<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3756808')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id', 'province_fk_3756848')->references('id')->on('provinces');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_3756809')->references('id')->on('countries');
            $table->unsignedBigInteger('nearest_shipping_port_id')->nullable();
            $table->foreign('nearest_shipping_port_id', 'nearest_shipping_port_fk_3795989')->references('id')->on('addresses');
        });
    }
}
