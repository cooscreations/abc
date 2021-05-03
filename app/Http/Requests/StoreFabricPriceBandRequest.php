<?php

namespace App\Http\Requests;

use App\Models\FabricPriceBand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFabricPriceBandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fabric_price_band_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'band_letter' => [
                'string',
                'nullable',
            ],
            'cny_start_price' => [
                'required',
            ],
            'cny_finish_price' => [
                'required',
            ],
        ];
    }
}
