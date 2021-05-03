<?php

namespace App\Http\Requests;

use App\Models\Complaint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreComplaintRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('complaint_create');
    }

    public function rules()
    {
        return [
            'afa_case_number' => [
                'string',
                'required',
            ],
            'qty_affected' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
