<?php

namespace App\Http\Requests;

use App\Models\BedSizeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBedSizeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bed_size_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'price_group_id' => [
                'required',
                'integer',
            ],
            'group_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mattress_min_w_mm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mattress_max_w_mm' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mattress_min_l_mm' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mattress_max_l_mm' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
