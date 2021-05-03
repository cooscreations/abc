<?php

namespace App\Http\Requests;

use App\Models\CompanyRole;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_role_create');
    }

    public function rules()
    {
        return [];
    }
}
