<?php

namespace App\Http\Requests;

use App\Models\ProductNickname;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductNicknameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_nickname_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'alt_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
