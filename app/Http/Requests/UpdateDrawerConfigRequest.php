<?php

namespace App\Http\Requests;

use App\Models\DrawerConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDrawerConfigRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('drawer_config_edit');
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
