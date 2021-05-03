<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeSupplierAuditPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_type_supplier_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_audit_id');
            $table->foreign('supplier_audit_id', 'supplier_audit_id_fk_3785098')->references('id')->on('supplier_audits')->onDelete('cascade');
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id', 'product_type_id_fk_3785098')->references('id')->on('product_types')->onDelete('cascade');
        });
    }
}
