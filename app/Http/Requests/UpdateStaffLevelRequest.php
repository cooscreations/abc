<?php

namespace App\Http\Requests;

use App\Models\StaffLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaffLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_level_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'list_order' => [
                'string',
                'nullable',
            ],
        ];
    }
}
