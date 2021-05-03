<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'short_code' => [
                'string',
                'required',
            ],
            'alpha_2' => [
                'string',
                'min:2',
                'max:2',
                'required',
            ],
            'alpha_3' => [
                'string',
                'min:3',
                'max:3',
                'nullable',
            ],
            'wiki_url' => [
                'string',
                'nullable',
            ],
            'iso_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
