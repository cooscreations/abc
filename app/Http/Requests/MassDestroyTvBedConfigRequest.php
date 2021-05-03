<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TvBedConfig;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTvBedConfigRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('tv_bed_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:tv_bed_configs,id',
]
    
}

}