<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PriceListType;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPriceListTypeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('price_list_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:price_list_types,id',
]
    
}

}