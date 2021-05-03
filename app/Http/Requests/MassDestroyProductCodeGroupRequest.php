<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ProductCodeGroup;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductCodeGroupRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('product_code_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:product_code_groups,id',
]
    
}

}