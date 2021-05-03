<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentOrderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_order', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3772496')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_3772496')->references('id')->on('orders')->onDelete('cascade');
        });
    }
}
