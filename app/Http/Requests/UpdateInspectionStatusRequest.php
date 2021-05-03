<?php

namespace App\Http\Requests;

use App\Models\InspectionStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInspectionStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inspection_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'list_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status_color_hex' => [
                'string',
                'nullable',
            ],
        ];
    }
}
