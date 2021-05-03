<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\RawMaterialType;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRawMaterialTypeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('raw_material_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:raw_material_types,id',
]
    
}

}