<?php

namespace App\Http\Requests;

use App\Models\EquipmentAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEquipmentAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('equipment_audit_create');
    }

    public function rules()
    {
        return [
            'qty' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
