<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentUserTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_user_type', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3772498')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('user_type_id');
            $table->foreign('user_type_id', 'user_type_id_fk_3772498')->references('id')->on('user_types')->onDelete('cascade');
        });
    }
}
