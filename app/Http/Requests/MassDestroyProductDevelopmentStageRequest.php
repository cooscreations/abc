<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ProductDevelopmentStage;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductDevelopmentStageRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('product_development_stage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:product_development_stages,id',
]
    
}

}