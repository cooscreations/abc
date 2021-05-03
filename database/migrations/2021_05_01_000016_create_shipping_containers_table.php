<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingContainersTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_containers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('container_number');
            $table->date('est_loading_date')->nullable();
            $table->date('actual_loading_date')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('so_date')->nullable();
            $table->date('si_date')->nullable();
            $table->date('estimated_time_of_departure')->nullable();
            $table->date('eta')->nullable();
            $table->date('copy_bl_rec_date')->nullable();
            $table->date('docs_sent_date')->nullable();
            $table->date('bl_release_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
