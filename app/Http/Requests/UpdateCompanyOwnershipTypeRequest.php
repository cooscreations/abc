<?php

namespace App\Http\Requests;

use App\Models\CompanyOwnershipType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCompanyOwnershipTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_ownership_type_edit');
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
