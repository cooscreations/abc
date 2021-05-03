<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfaStaffInspectionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('afa_staff_inspection', function (Blueprint $table) {
            $table->unsignedBigInteger('inspection_id');
            $table->foreign('inspection_id', 'inspection_id_fk_3796542')->references('id')->on('inspections')->onDelete('cascade');
            $table->unsignedBigInteger('afa_staff_id');
            $table->foreign('afa_staff_id', 'afa_staff_id_fk_3796542')->references('id')->on('afa_staffs')->onDelete('cascade');
        });
    }
}
