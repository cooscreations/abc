<?php

namespace App\Http\Requests;

use App\Models\CompanyType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'list_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
