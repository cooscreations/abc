<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->foreign('document_type_id', 'document_type_fk_3757099')->references('id')->on('document_types');
            $table->unsignedBigInteger('file_type_id')->nullable();
            $table->foreign('file_type_id', 'file_type_fk_3757100')->references('id')->on('file_types');
        });
    }
}
