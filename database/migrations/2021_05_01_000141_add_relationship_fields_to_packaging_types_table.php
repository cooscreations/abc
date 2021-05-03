<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPackagingTypesTable extends Migration
{
    public function up()
    {
        Schema::table('packaging_types', function (Blueprint $table) {
            $table->unsignedBigInteger('primary_material_id')->nullable();
            $table->foreign('primary_material_id', 'primary_material_fk_3757279')->references('id')->on('raw_materials');
        });
    }
}
