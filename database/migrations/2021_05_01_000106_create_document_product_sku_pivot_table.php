<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentProductSkuPivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_product_sku', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3772497')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('product_sku_id');
            $table->foreign('product_sku_id', 'product_sku_id_fk_3772497')->references('id')->on('product_skus')->onDelete('cascade');
        });
    }
}
