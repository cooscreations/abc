<?php

namespace App\Http\Requests;

use App\Models\DrawerMovement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDrawerMovementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('drawer_movement_edit');
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
