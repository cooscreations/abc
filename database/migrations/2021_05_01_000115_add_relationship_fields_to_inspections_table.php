<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInspectionsTable extends Migration
{
    public function up()
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_3757753')->references('id')->on('orders');
            $table->unsignedBigInteger('inspector_name_id');
            $table->foreign('inspector_name_id', 'inspector_name_fk_3757754')->references('id')->on('afa_staffs');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_3757756')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('order_follower_id')->nullable();
            $table->foreign('order_follower_id', 'order_follower_fk_3796464')->references('id')->on('afa_staffs');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id', 'supplier_fk_3757755')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->foreign('order_item_id', 'order_item_fk_3772494')->references('id')->on('order_items');
            $table->unsignedBigInteger('qc_status_id')->nullable();
            $table->foreign('qc_status_id', 'qc_status_fk_3796536')->references('id')->on('inspection_statuses');
        });
    }
}
