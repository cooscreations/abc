<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToShippingContainersTable extends Migration
{
    public function up()
    {
        Schema::table('shipping_containers', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_3756952')->references('id')->on('orders');
            $table->unsignedBigInteger('shipping_company_id')->nullable();
            $table->foreign('shipping_company_id', 'shipping_company_fk_3756950')->references('id')->on('contact_companies');
        });
    }
}
