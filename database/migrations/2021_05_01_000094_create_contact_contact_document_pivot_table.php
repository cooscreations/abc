<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactDocumentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contact_document', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3757098')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_3757098')->references('id')->on('contact_contacts')->onDelete('cascade');
        });
    }
}
