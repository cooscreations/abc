<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSupplierAuditsTable extends Migration
{
    public function up()
    {
        Schema::table('supplier_audits', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id', 'supplier_fk_3782759')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('inspector_id');
            $table->foreign('inspector_id', 'inspector_fk_3782760')->references('id')->on('users');
            $table->unsignedBigInteger('client_1_country_id')->nullable();
            $table->foreign('client_1_country_id', 'client_1_country_fk_3785096')->references('id')->on('countries');
            $table->unsignedBigInteger('client_1_company_id')->nullable();
            $table->foreign('client_1_company_id', 'client_1_company_fk_3785097')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('client_2_country_id')->nullable();
            $table->foreign('client_2_country_id', 'client_2_country_fk_3785101')->references('id')->on('countries');
            $table->unsignedBigInteger('client_2_company_id')->nullable();
            $table->foreign('client_2_company_id', 'client_2_company_fk_3785102')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('client_3_country_id')->nullable();
            $table->foreign('client_3_country_id', 'client_3_country_fk_3785106')->references('id')->on('countries');
            $table->unsignedBigInteger('client_3_company_id')->nullable();
            $table->foreign('client_3_company_id', 'client_3_company_fk_3785107')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('primary_materials_id')->nullable();
            $table->foreign('primary_materials_id', 'primary_materials_fk_3795994')->references('id')->on('raw_materials');
        });
    }
}
