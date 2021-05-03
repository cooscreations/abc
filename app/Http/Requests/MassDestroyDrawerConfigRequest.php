<?php

namespace App\Http\Requests;

use App\Models\DrawerConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDrawerConfigRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('drawer_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:drawer_configs,id',
        ];
    }
}
