<?php

namespace App\Http\Requests;

use App\Models\PriceList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePriceListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('price_list_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
