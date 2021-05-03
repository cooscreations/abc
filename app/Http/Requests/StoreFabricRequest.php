<?php

namespace App\Http\Requests;

use App\Models\Fabric;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFabricRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fabric_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'fabric_group_id' => [
                'required',
                'integer',
            ],
            'fabric_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
