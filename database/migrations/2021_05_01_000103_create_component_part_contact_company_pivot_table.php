<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentPartContactCompanyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('component_part_contact_company', function (Blueprint $table) {
            $table->unsignedBigInteger('component_part_id');
            $table->foreign('component_part_id', 'component_part_id_fk_3772488')->references('id')->on('component_parts')->onDelete('cascade');
            $table->unsignedBigInteger('contact_company_id');
            $table->foreign('contact_company_id', 'contact_company_id_fk_3772488')->references('id')->on('contact_companies')->onDelete('cascade');
        });
    }
}
