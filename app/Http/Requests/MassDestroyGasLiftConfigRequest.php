<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\GasLiftConfig;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGasLiftConfigRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('gas_lift_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:gas_lift_configs,id',
]
    
}

}