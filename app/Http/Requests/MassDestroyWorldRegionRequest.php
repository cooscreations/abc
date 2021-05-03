<?php

namespace App\Http\Requests;

use App\Models\WorldRegion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorldRegionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('world_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:world_regions,id',
        ];
    }
}
