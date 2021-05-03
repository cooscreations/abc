<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompanyProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_company_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_3772459')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('contact_company_id');
            $table->foreign('contact_company_id', 'contact_company_id_fk_3772459')->references('id')->on('contact_companies')->onDelete('cascade');
        });
    }
}
