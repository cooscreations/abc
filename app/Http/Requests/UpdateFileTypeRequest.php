<?php

namespace App\Http\Requests;

use App\Models\FileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('file_type_edit');
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
