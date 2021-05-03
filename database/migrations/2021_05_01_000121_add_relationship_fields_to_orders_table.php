<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->foreign('sales_person_id', 'sales_person_fk_3796254')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('order_follower_id')->nullable();
            $table->foreign('order_follower_id', 'order_follower_fk_3796255')->references('id')->on('afa_staffs');
            $table->unsignedBigInteger('order_status_id');
            $table->foreign('order_status_id', 'order_status_fk_3757620')->references('id')->on('order_statuses');
            $table->unsignedBigInteger('order_type_id')->nullable();
            $table->foreign('order_type_id', 'order_type_fk_3758426')->references('id')->on('ordertypes');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_3756800')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('order_placed_by_id');
            $table->foreign('order_placed_by_id', 'order_placed_by_fk_3756865')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('shipping_agent_id')->nullable();
            $table->foreign('shipping_agent_id', 'shipping_agent_fk_3758285')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('ship_from_port_id')->nullable();
            $table->foreign('ship_from_port_id', 'ship_from_port_fk_3802180')->references('id')->on('addresses');
            $table->unsignedBigInteger('ship_to_port_id')->nullable();
            $table->foreign('ship_to_port_id', 'ship_to_port_fk_3802181')->references('id')->on('addresses');
            $table->unsignedBigInteger('ship_to_address_id')->nullable();
            $table->foreign('ship_to_address_id', 'ship_to_address_fk_3756859')->references('id')->on('addresses');
            $table->unsignedBigInteger('bill_to_address_id')->nullable();
            $table->foreign('bill_to_address_id', 'bill_to_address_fk_3756858')->references('id')->on('addresses');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id', 'supplier_fk_3756801')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('packaging_type_id')->nullable();
            $table->foreign('packaging_type_id', 'packaging_type_fk_3802230')->references('id')->on('packaging_types');
            $table->unsignedBigInteger('afa_bank_account_to_pay_id')->nullable();
            $table->foreign('afa_bank_account_to_pay_id', 'afa_bank_account_to_pay_fk_3802420')->references('id')->on('bank_accounts');
        });
    }
}
