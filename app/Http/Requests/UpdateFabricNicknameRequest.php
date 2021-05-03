<?php

namespace App\Http\Requests;

use App\Models\FabricNickname;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFabricNicknameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fabric_nickname_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'fabric_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
