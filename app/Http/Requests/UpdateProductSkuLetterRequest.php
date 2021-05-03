<?php

namespace App\Http\Requests;

use App\Models\ProductSkuLetter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductSkuLetterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_sku_letter_edit');
    }

    public function rules()
    {
        return [
            'letter_code' => [
                'string',
                'required',
            ],
            'full_name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'sharepoint_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
