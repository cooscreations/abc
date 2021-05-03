<?php

namespace App\Http\Requests;

use App\Models\ProductSizeName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductSizeNameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_size_name_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'code' => [
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
