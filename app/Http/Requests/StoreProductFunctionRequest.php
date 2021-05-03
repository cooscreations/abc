<?php

namespace App\Http\Requests;

use App\Models\ProductFunction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductFunctionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_function_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'public_icon_url' => [
                'string',
                'nullable',
            ],
            'list_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
