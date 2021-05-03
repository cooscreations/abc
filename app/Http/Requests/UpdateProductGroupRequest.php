<?php

namespace App\Http\Requests;

use App\Models\ProductGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_group_edit');
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
            'sharepoint_url' => [
                'string',
                'nullable',
            ],
            'public_logo_url' => [
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
