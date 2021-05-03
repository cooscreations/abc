<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductNicknamesTable extends Migration
{
    public function up()
    {
        Schema::table('product_nicknames', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3756778')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3756779')->references('id')->on('products');
        });
    }
}
