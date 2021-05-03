<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPriceListsTable extends Migration
{
    public function up()
    {
        Schema::table('price_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_3757152')->references('id')->on('price_list_types');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_3757153')->references('id')->on('price_list_groups');
        });
    }
}
