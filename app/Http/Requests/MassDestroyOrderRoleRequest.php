<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\OrderRole;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrderRoleRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('order_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:order_roles,id',
]
    
}

}