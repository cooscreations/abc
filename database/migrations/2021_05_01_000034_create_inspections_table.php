<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('afa_order_number')->nullable();
            $table->string('customer_order_number')->nullable();
            $table->integer('qty_inspected');
            $table->boolean('inspection_passed')->default(0);
            $table->date('inspection_planned_date')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('crd_inspection_complete_date')->nullable();
            $table->integer('total_days_inspection_open')->nullable();
            $table->integer('total_days_on_site')->nullable();
            $table->date('qc_report_received')->nullable();
            $table->date('qe_audit_complete_date')->nullable();
            $table->date('qc_report_sent_to_customer_date')->nullable();
            $table->string('sharepoint_photos_url')->nullable();
            $table->date('fabric_received_date')->nullable();
            $table->longText('inspector_private_notes')->nullable();
            $table->longText('public_notes')->nullable();
            $table->date('qc_paid_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
