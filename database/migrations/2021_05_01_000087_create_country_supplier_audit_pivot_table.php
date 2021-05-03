<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrySupplierAuditPivotTable extends Migration
{
    public function up()
    {
        Schema::create('country_supplier_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_audit_id');
            $table->foreign('supplier_audit_id', 'supplier_audit_id_fk_3783557')->references('id')->on('supplier_audits')->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_id_fk_3783557')->references('id')->on('countries')->onDelete('cascade');
        });
    }
}
