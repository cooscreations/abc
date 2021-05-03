<?php

namespace App\Http\Requests;

use App\Models\FileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('file_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'hex_color_code' => [
                'string',
                'nullable',
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
