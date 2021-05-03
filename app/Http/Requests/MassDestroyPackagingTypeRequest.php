<?php

namespace App\Http\Requests;

use App\Models\PackagingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPackagingTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('packaging_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:packaging_types,id',
        ];
    }
}
