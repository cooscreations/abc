<?php

namespace App\Http\Requests;

use App\Models\Address;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('address_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'add_line_1' => [
                'string',
                'nullable',
            ],
            'add_line_2' => [
                'string',
                'nullable',
            ],
            'add_line_3' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
        ];
    }
}
