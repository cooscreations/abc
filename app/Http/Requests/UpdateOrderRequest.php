<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'afa_order_num' => [
                'string',
                'required',
            ],
            'cust_order_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'order_status_id' => [
                'required',
                'integer',
            ],
            'customer_order_number' => [
                'string',
                'nullable',
            ],
            'customer_id' => [
                'required',
                'integer',
            ],
            'order_placed_by_id' => [
                'required',
                'integer',
            ],
            'customer_deposit_rate' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cust_dep_rec_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'order_sent_to_supplier_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'customer_required_ship_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'crd_target_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'quality_control_staffs.*' => [
                'integer',
            ],
            'quality_control_staffs' => [
                'array',
            ],
            'booking_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'so_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'balance_received_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'supplier_deposit_paid_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'documents_received_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'supplier_balance_paid_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'commission_paid_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'req_fumigtion' => [
                'string',
                'nullable',
            ],
            'profit_ratio' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'fn_audit_complete_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'total_days_to_complete' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qty_tolerance' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'size_tolerance' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'leadtime_days' => [
                'string',
                'nullable',
            ],
            'cny_to_usd_rate_today' => [
                'numeric',
            ],
            'price_expiry_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
