<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('fabric_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('afa_fabric_group_code')->nullable();
            $table->string('primary_supplier_group_code')->nullable();
            $table->string('sharepoint_url')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
