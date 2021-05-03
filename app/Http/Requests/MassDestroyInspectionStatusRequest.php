<?php

namespace App\Http\Requests;

use App\Models\InspectionStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInspectionStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('inspection_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:inspection_statuses,id',
        ];
    }
}
