<?php

namespace App\Http\Requests;

use App\Models\PriceListType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePriceListTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('price_list_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
