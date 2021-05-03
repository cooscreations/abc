<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPackagingsTable extends Migration
{
    public function up()
    {
        Schema::table('packagings', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3757401')->references('id')->on('products');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_3757402')->references('id')->on('packaging_types');
        });
    }
}
