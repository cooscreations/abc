<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('afa_order_num');
            $table->datetime('cust_order_date');
            $table->boolean('ukfr')->default(0)->nullable();
            $table->string('customer_order_number')->nullable();
            $table->decimal('pi_value_placed_usd', 15, 2)->nullable();
            $table->decimal('ci_value_shipped_usd', 15, 2)->nullable();
            $table->decimal('customer_deposit_value_usd', 15, 2)->nullable();
            $table->integer('customer_deposit_rate')->nullable();
            $table->date('cust_dep_rec_date')->nullable();
            $table->date('order_sent_to_supplier_date')->nullable();
            $table->decimal('allowance_usd', 15, 2)->nullable();
            $table->date('customer_required_ship_date')->nullable();
            $table->date('crd_target_date')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('so_date')->nullable();
            $table->decimal('customer_balance_usd', 15, 2)->nullable();
            $table->date('balance_received_date')->nullable();
            $table->decimal('po_value_placed_usd', 15, 2)->nullable();
            $table->decimal('po_value_shipped_usd', 15, 2)->nullable();
            $table->decimal('supplier_deposit_usd', 15, 2)->nullable();
            $table->date('supplier_deposit_paid_date')->nullable();
            $table->decimal('handling_charge_and_allowance_usd', 15, 2)->nullable();
            $table->date('documents_received_date')->nullable();
            $table->decimal('supplier_balance_usd', 15, 2)->nullable();
            $table->date('supplier_balance_paid_date')->nullable();
            $table->decimal('commission_usd', 15, 2)->nullable();
            $table->date('commission_paid_date')->nullable();
            $table->string('req_fumigtion')->nullable();
            $table->decimal('fumigation_cost_usd', 15, 2)->nullable();
            $table->decimal('profit_usd', 15, 2)->nullable();
            $table->float('profit_ratio', 15, 2)->nullable();
            $table->date('fn_audit_complete_date')->nullable();
            $table->integer('total_days_to_complete')->nullable();
            $table->integer('qty_tolerance')->nullable();
            $table->integer('size_tolerance')->nullable();
            $table->string('leadtime_days')->nullable();
            $table->float('cny_to_usd_rate_today', 15, 2)->nullable();
            $table->date('price_expiry_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
