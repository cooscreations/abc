<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_product', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3757095')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_3757095')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
