<?php

namespace App\Http\Requests;

use App\Models\PackagingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackagingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('packaging_type_create');
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
