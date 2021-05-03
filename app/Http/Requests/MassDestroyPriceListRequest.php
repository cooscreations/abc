<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PriceList;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPriceListRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('price_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:price_lists,id',
]
    
}

}