<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FileType;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFileTypeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('file_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:file_types,id',
]
    
}

}