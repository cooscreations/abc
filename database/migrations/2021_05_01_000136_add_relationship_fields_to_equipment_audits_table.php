<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEquipmentAuditsTable extends Migration
{
    public function up()
    {
        Schema::table('equipment_audits', function (Blueprint $table) {
            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->foreign('equipment_id', 'equipment_fk_3757070')->references('id')->on('equipment');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_3757071')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_3757073')->references('id')->on('addresses');
        });
    }
}
