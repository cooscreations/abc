<?php

namespace App\Http\Requests;

use App\Models\ProductCollection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductCollectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_collection_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'public_logo_url' => [
                'string',
                'nullable',
            ],
            'public_url' => [
                'string',
                'nullable',
            ],
            'share_point_url' => [
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
