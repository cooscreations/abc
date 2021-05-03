<?php

namespace App\Http\Requests;

use App\Models\CompanyOwnershipType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyOwnershipTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_ownership_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
