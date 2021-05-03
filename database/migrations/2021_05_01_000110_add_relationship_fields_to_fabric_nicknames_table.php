<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFabricNicknamesTable extends Migration
{
    public function up()
    {
        Schema::table('fabric_nicknames', function (Blueprint $table) {
            $table->unsignedBigInteger('fabric_id');
            $table->foreign('fabric_id', 'fabric_fk_3757481')->references('id')->on('fabrics');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_3757482')->references('id')->on('contact_companies');
        });
    }
}
