<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRawMaterialsTable extends Migration
{
    public function up()
    {
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('std_material_finish_id')->nullable();
            $table->foreign('std_material_finish_id', 'std_material_finish_fk_3756769')->references('id')->on('material_finishes');
        });
    }
}
