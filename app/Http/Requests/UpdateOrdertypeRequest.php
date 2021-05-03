<?php

namespace App\Http\Requests;

use App\Models\Ordertype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrdertypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ordertype_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
