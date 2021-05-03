<?php

namespace App\Http\Requests;

use App\Models\ComponentPartName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComponentPartNameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('component_part_name_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'short_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
