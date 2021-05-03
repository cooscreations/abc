<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEquipmentTable extends Migration
{
    public function up()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id', 'manufacturer_fk_3757056')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('equipment_type_id')->nullable();
            $table->foreign('equipment_type_id', 'equipment_type_fk_3757057')->references('id')->on('equipment_types');
        });
    }
}
