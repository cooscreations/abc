<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ProductSkuLetter;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductSkuLetterRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('product_sku_letter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:product_sku_letters,id',
]
    
}

}