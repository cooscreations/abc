<?php

namespace App\Http\Requests;

use App\Models\YesNoMaybe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateYesNoMaybeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('yes_no_maybe_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'default_css_class' => [
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
