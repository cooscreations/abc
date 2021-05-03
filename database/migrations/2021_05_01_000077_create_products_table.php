<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('afa_model_number')->unique();
            $table->date('date_launched')->nullable();
            $table->integer('std_qty_feet')->nullable();
            $table->string('std_qty_boxes')->nullable();
            $table->longText('public_description')->nullable();
            $table->string('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
