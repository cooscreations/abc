<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\EquipmentAudit;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEquipmentAuditRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('equipment_audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:equipment_audits,id',
]
    
}

}