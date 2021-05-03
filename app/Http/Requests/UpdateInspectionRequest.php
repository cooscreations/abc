<?php

namespace App\Http\Requests;

use App\Models\Inspection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInspectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inspection_edit');
    }

    public function rules()
    {
        return [
            'afa_order_number' => [
                'string',
                'nullable',
            ],
            'inspector_name_id' => [
                'required',
                'integer',
            ],
            'customer_id' => [
                'required',
                'integer',
            ],
            'customer_order_number' => [
                'string',
                'nullable',
            ],
            'supplier_id' => [
                'required',
                'integer',
            ],
            'qty_inspected' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'inspection_passed' => [
                'required',
            ],
            'inspection_planned_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'actual_start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'crd_inspection_complete_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'total_days_inspection_open' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_days_on_site' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'additional_q_cs.*' => [
                'integer',
            ],
            'additional_q_cs' => [
                'array',
            ],
            'qc_report_received' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'qe_audit_complete_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'qc_report_sent_to_customer_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'sharepoint_photos_url' => [
                'string',
                'nullable',
            ],
            'fabric_received_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'qc_paid_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
