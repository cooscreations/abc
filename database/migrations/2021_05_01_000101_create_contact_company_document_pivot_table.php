<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompanyDocumentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_company_document', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_3757097')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedBigInteger('contact_company_id');
            $table->foreign('contact_company_id', 'contact_company_id_fk_3757097')->references('id')->on('contact_companies')->onDelete('cascade');
        });
    }
}
