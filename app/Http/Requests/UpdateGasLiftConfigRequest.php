<?php

namespace App\Http\Requests;

use App\Models\GasLiftConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGasLiftConfigRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gas_lift_config_edit');
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
