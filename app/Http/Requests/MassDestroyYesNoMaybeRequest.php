<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\YesNoMaybe;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyYesNoMaybeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('yes_no_maybe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:yes_no_maybes,id',
]
    
}

}