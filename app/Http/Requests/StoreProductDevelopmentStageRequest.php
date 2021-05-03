<?php

namespace App\Http\Requests;

use App\Models\ProductDevelopmentStage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductDevelopmentStageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_development_stage_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'list_order' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
