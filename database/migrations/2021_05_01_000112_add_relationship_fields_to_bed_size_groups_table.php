<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBedSizeGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('bed_size_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('price_group_id');
            $table->foreign('price_group_id', 'price_group_fk_3757582')->references('id')->on('price_list_groups');
        });
    }
}
