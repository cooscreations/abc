<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFabricGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('fabric_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('primary_supplier_id')->nullable();
            $table->foreign('primary_supplier_id', 'primary_supplier_fk_3757427')->references('id')->on('contact_companies');
        });
    }
}
