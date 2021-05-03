<?php

namespace App\Http\Requests;

use App\Models\StorageOption;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStorageOptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('storage_option_edit');
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
            'list_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
