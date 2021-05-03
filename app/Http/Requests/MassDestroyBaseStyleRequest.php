<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BaseStyle;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBaseStyleRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('base_style_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:base_styles,id',
]
    
}

}