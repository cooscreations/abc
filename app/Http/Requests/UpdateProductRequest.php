<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'afa_model_number' => [
                'string',
                'required',
                'unique:products,afa_model_number,' . request()->route('product')->id,
            ],
            'extra_letters_used_in_skus.*' => [
                'integer',
            ],
            'extra_letters_used_in_skus' => [
                'array',
            ],
            'date_launched' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'primary_suppliers.*' => [
                'integer',
            ],
            'primary_suppliers' => [
                'array',
            ],
            'std_qty_feet' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'std_qty_boxes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
