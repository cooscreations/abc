<?php

namespace App\Http\Requests;

use App\Models\BaseStyle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBaseStyleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('base_style_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
