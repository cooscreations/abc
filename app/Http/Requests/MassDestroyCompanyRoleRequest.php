<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CompanyRole;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompanyRoleRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('company_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:company_roles,id',
]
    
}

}