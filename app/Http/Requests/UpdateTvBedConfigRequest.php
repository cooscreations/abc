<?php

namespace App\Http\Requests;

use App\Models\TvBedConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTvBedConfigRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tv_bed_config_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'public_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
