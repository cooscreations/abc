<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductSkuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_sku_create');
    }

    public function rules()
    {
        return [
            'product_sku' => [
                'string',
                'nullable',
            ],
            'size_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
