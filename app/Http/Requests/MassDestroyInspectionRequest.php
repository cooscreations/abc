<?php

namespace App\Http\Requests;

use App\Models\Inspection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInspectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:inspections,id',
        ];
    }
}
