<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CompanyOwnershipType;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompanyOwnershipTypeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('company_ownership_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:company_ownership_types,id',
]
    
}

}