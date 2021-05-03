<?php

namespace App\Http\Requests;

use App\Models\FabricGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFabricGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fabric_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fabric_groups,id',
        ];
    }
}
