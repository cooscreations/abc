<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BedSizeGroup;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBedSizeGroupRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('bed_size_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:bed_size_groups,id',
]
    
}

}