<?php

namespace App\Http\Requests;

use App\Models\SupplierAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupplierAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('supplier_audit_create');
    }

    public function rules()
    {
        return [
            'inspector_id' => [
                'required',
                'integer',
            ],
            'audit_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'total_land_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'factory_area_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'production_area_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'inspection_area_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'packing_area_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'warehouse_area_sqm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_process_workers' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_admin_supervisors' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_r_and_d_staff' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_technicians' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_inline_qc' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_final_qc' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_packing_staff' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_total_staff' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_production_sites' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'export_countries.*' => [
                'integer',
            ],
            'export_countries' => [
                'array',
            ],
            'qty_hrs_per_day' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_hrs_per_week' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_work_days_per_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'wood_moisture' => [
                'string',
                'nullable',
            ],
            'wood_drying' => [
                'string',
                'nullable',
            ],
            'wood_quality' => [
                'string',
                'nullable',
            ],
            'wood_storage' => [
                'string',
                'nullable',
            ],
            'foam_density' => [
                'string',
                'nullable',
            ],
            'foam_identification' => [
                'string',
                'nullable',
            ],
            'composite_wood_identification' => [
                'string',
                'nullable',
            ],
            'qty_major_subcontractors' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_subcontractors_per_component' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'avg_num_yrs_with_subcontractors' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month_cap_40_hq' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'annual_cap_40_hq' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month_cap_40_hq_free' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'moq_40_hq' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'std_lead_time_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sample_lead_time_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'client_1_name' => [
                'string',
                'nullable',
            ],
            'client_1_product_types.*' => [
                'integer',
            ],
            'client_1_product_types' => [
                'array',
            ],
            'client_1_containers_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'client_2_name' => [
                'string',
                'nullable',
            ],
            'client_2_product_type' => [
                'string',
                'nullable',
            ],
            'client_2_containers_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'client_3_name' => [
                'string',
                'nullable',
            ],
            'client_3_product_type' => [
                'string',
                'nullable',
            ],
            'client_3_containers_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
