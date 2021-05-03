<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierAudit extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'supplier_audits';

    public static $searchable = [
        'subcontracted_items',
        'client_1_name',
        'client_2_product_type',
        'client_3_product_type',
    ];

    protected $dates = [
        'audit_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'supplier_id',
        'inspector_id',
        'audit_date',
        'passed_audit',
        'total_land_sqm',
        'factory_area_sqm',
        'production_area_sqm',
        'inspection_area_sqm',
        'packing_area_sqm',
        'warehouse_area_sqm',
        'qty_process_workers',
        'qty_admin_supervisors',
        'qty_r_and_d_staff',
        'qty_technicians',
        'qty_inline_qc',
        'qty_final_qc',
        'qty_packing_staff',
        'qty_total_staff',
        'qty_production_sites',
        'is_self_owned',
        'has_english_speaking_staff',
        'annual_domestic_turnover_usd',
        'annual_international_turnover_usd',
        'has_social_iso_9001',
        'has_production_iso_9001',
        'qty_hrs_per_day',
        'qty_hrs_per_week',
        'qty_work_days_per_month',
        'ppe_provided',
        'ppe_used',
        'safe_chemical_storage',
        'wood_moisture',
        'wood_drying',
        'wood_quality',
        'wood_storage',
        'ukfr_cali_foam_ok',
        'foam_density',
        'foam_identification',
        'composite_wood_identification',
        'passed_pu_pvc_reach_phthalat',
        'passed_silica_gel_bag_dmf',
        'passed_mdf_pw_pb',
        'subcontracted_items',
        'qty_major_subcontractors',
        'qty_subcontractors_per_component',
        'avg_num_yrs_with_subcontractors',
        'regular_subcontractors',
        'month_cap_40_hq',
        'annual_cap_40_hq',
        'month_cap_40_hq_free',
        'moq_40_hq',
        'std_lead_time_days',
        'sample_lead_time_days',
        'pass_qc_doc_audit',
        'has_full_iqc',
        'has_full_oqc',
        'has_reg_qc_training',
        'client_1_name',
        'client_1_country_id',
        'client_1_company_id',
        'client_1_containers_month',
        'client_2_name',
        'client_2_country_id',
        'client_2_company_id',
        'client_2_product_type',
        'client_2_containers_month',
        'client_3_name',
        'client_3_country_id',
        'client_3_company_id',
        'client_3_product_type',
        'client_3_containers_month',
        'address_confirmed',
        'pay_minimum_wage',
        'withhold_salary',
        'overtime_rate_usd',
        'primary_materials_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(ContactCompany::class, 'supplier_id');
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function getAuditDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAuditDateAttribute($value)
    {
        $this->attributes['audit_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function export_countries()
    {
        return $this->belongsToMany(Country::class);
    }

    public function client_1_country()
    {
        return $this->belongsTo(Country::class, 'client_1_country_id');
    }

    public function client_1_company()
    {
        return $this->belongsTo(ContactCompany::class, 'client_1_company_id');
    }

    public function client_1_product_types()
    {
        return $this->belongsToMany(ProductType::class);
    }

    public function client_2_country()
    {
        return $this->belongsTo(Country::class, 'client_2_country_id');
    }

    public function client_2_company()
    {
        return $this->belongsTo(ContactCompany::class, 'client_2_company_id');
    }

    public function client_3_country()
    {
        return $this->belongsTo(Country::class, 'client_3_country_id');
    }

    public function client_3_company()
    {
        return $this->belongsTo(ContactCompany::class, 'client_3_company_id');
    }

    public function primary_materials()
    {
        return $this->belongsTo(RawMaterial::class, 'primary_materials_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
