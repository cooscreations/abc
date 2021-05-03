<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DrawerMovement;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDrawerMovementRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('drawer_movement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:drawer_movements,id',
]
    
}

}