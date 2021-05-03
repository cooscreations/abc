<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BedSizesByRegion;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBedSizesByRegionRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('bed_sizes_by_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:bed_sizes_by_regions,id',
]
    
}

}