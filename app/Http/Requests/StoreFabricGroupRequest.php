<?php

namespace App\Http\Requests;

use App\Models\FabricGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFabricGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fabric_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'afa_fabric_group_code' => [
                'string',
                'nullable',
            ],
            'primary_supplier_group_code' => [
                'string',
                'nullable',
            ],
            'sharepoint_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
