<?php

namespace App\Http\Requests;

use App\Models\ProductCodeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductCodeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_code_group_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'range_start' => [
                'string',
                'nullable',
            ],
            'range_end' => [
                'string',
                'nullable',
            ],
            'product_collections.*' => [
                'integer',
            ],
            'product_collections' => [
                'array',
            ],
            'product_functions.*' => [
                'integer',
            ],
            'product_functions' => [
                'array',
            ],
            'product_types.*' => [
                'integer',
            ],
            'product_types' => [
                'array',
            ],
            'storage_options.*' => [
                'integer',
            ],
            'storage_options' => [
                'array',
            ],
        ];
    }
}
