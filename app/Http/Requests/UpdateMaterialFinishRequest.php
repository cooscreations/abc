<?php

namespace App\Http\Requests;

use App\Models\MaterialFinish;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaterialFinishRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_finish_edit');
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
