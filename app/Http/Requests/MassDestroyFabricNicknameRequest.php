<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FabricNickname;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFabricNicknameRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('fabric_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:fabric_nicknames,id',
]
    
}

}