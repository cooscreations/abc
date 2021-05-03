<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ComplaintStatus;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyComplaintStatusRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('complaint_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:complaint_statuses,id',
]
    
}

}