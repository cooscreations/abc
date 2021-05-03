<?php

namespace App\Http\Requests;

use App\Models\FabricPriceBand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFabricPriceBandRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fabric_price_band_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fabric_price_bands,id',
        ];
    }
}
