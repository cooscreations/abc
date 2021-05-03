<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('supplier_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('audit_date')->nullable();
            $table->boolean('passed_audit')->default(0)->nullable();
            $table->integer('total_land_sqm')->nullable();
            $table->integer('factory_area_sqm')->nullable();
            $table->integer('production_area_sqm')->nullable();
            $table->integer('inspection_area_sqm')->nullable();
            $table->integer('packing_area_sqm')->nullable();
            $table->integer('warehouse_area_sqm')->nullable();
            $table->integer('qty_process_workers')->nullable();
            $table->integer('qty_admin_supervisors')->nullable();
            $table->integer('qty_r_and_d_staff')->nullable();
            $table->integer('qty_technicians')->nullable();
            $table->integer('qty_inline_qc')->nullable();
            $table->integer('qty_final_qc')->nullable();
            $table->integer('qty_packing_staff')->nullable();
            $table->integer('qty_total_staff')->nullable();
            $table->integer('qty_production_sites')->nullable();
            $table->boolean('is_self_owned')->default(0)->nullable();
            $table->boolean('has_english_speaking_staff')->default(0)->nullable();
            $table->decimal('annual_domestic_turnover_usd', 15, 2)->nullable();
            $table->decimal('annual_international_turnover_usd', 15, 2)->nullable();
            $table->boolean('has_social_iso_9001')->default(0)->nullable();
            $table->boolean('has_production_iso_9001')->default(0)->nullable();
            $table->integer('qty_hrs_per_day')->nullable();
            $table->integer('qty_hrs_per_week')->nullable();
            $table->integer('qty_work_days_per_month')->nullable();
            $table->boolean('ppe_provided')->default(0)->nullable();
            $table->boolean('ppe_used')->default(0)->nullable();
            $table->boolean('safe_chemical_storage')->default(0)->nullable();
            $table->string('wood_moisture')->nullable();
            $table->string('wood_drying')->nullable();
            $table->string('wood_quality')->nullable();
            $table->string('wood_storage')->nullable();
            $table->boolean('ukfr_cali_foam_ok')->default(0)->nullable();
            $table->string('foam_density')->nullable();
            $table->string('foam_identification')->nullable();
            $table->string('composite_wood_identification')->nullable();
            $table->boolean('passed_pu_pvc_reach_phthalat')->default(0)->nullable();
            $table->boolean('passed_silica_gel_bag_dmf')->default(0)->nullable();
            $table->boolean('passed_mdf_pw_pb')->default(0)->nullable();
            $table->longText('subcontracted_items')->nullable();
            $table->integer('qty_major_subcontractors')->nullable();
            $table->integer('qty_subcontractors_per_component')->nullable();
            $table->integer('avg_num_yrs_with_subcontractors')->nullable();
            $table->boolean('regular_subcontractors')->default(0)->nullable();
            $table->integer('month_cap_40_hq')->nullable();
            $table->integer('annual_cap_40_hq')->nullable();
            $table->integer('month_cap_40_hq_free')->nullable();
            $table->integer('moq_40_hq')->nullable();
            $table->integer('std_lead_time_days')->nullable();
            $table->integer('sample_lead_time_days')->nullable();
            $table->boolean('pass_qc_doc_audit')->default(0)->nullable();
            $table->boolean('has_full_iqc')->default(0)->nullable();
            $table->boolean('has_full_oqc')->default(0)->nullable();
            $table->boolean('has_reg_qc_training')->default(0)->nullable();
            $table->string('client_1_name')->nullable();
            $table->integer('client_1_containers_month')->nullable();
            $table->string('client_2_name')->nullable();
            $table->string('client_2_product_type')->nullable();
            $table->integer('client_2_containers_month')->nullable();
            $table->string('client_3_name')->nullable();
            $table->string('client_3_product_type')->nullable();
            $table->integer('client_3_containers_month')->nullable();
            $table->boolean('address_confirmed')->default(0)->nullable();
            $table->boolean('pay_minimum_wage')->default(0)->nullable();
            $table->boolean('withhold_salary')->default(0)->nullable();
            $table->decimal('overtime_rate_usd', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
