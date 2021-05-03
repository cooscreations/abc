<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFabricsTable extends Migration
{
    public function up()
    {
        Schema::table('fabrics', function (Blueprint $table) {
            $table->unsignedBigInteger('fabric_group_id');
            $table->foreign('fabric_group_id', 'fabric_group_fk_3757466')->references('id')->on('fabric_groups');
        });
    }
}
