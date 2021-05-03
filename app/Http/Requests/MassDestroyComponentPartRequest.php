<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ComponentPart;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyComponentPartRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('component_part_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:component_parts,id',
]
    
}

}