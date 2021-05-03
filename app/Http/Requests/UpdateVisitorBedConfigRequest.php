<?php

namespace App\Http\Requests;

use App\Models\VisitorBedConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVisitorBedConfigRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitor_bed_config_edit');
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
