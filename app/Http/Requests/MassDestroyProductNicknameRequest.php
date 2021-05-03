<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ProductNickname;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductNicknameRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('product_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:product_nicknames,id',
]
    
}

}