<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\MaterialFinish;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMaterialFinishRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('material_finish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:material_finishes,id',
]
    
}

}