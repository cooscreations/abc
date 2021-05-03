<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfaStaffOrderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('afa_staff_order', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_3796260')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('afa_staff_id');
            $table->foreign('afa_staff_id', 'afa_staff_id_fk_3796260')->references('id')->on('afa_staffs')->onDelete('cascade');
        });
    }
}
