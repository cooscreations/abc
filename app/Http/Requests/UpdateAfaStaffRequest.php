<?php

namespace App\Http\Requests;

use App\Models\AfaStaff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAfaStaffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('afa_staff_edit');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'nullable',
            ],
            'date_started' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_finished' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'department_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
