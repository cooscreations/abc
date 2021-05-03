<?php

namespace App\Http\Requests;

use App\Models\RawMaterialType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRawMaterialTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('raw_material_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'public_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
