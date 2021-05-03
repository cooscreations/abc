<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ordertype;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrdertypeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('ordertype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:ordertypes,id',
]
    
}

}