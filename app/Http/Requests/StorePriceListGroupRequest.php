<?php

namespace App\Http\Requests;

use App\Models\PriceListGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePriceListGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('price_list_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
