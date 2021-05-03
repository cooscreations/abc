<?php

namespace App\Http\Requests;

use App\Models\ComponentPart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComponentPartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('component_part_edit');
    }

    public function rules()
    {
        return [
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'length_mm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'width_mm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'height_mm' => [
                'string',
                'nullable',
            ],
            'weight_g' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'primary_suppliers.*' => [
                'integer',
            ],
            'primary_suppliers' => [
                'array',
            ],
        ];
    }
}
