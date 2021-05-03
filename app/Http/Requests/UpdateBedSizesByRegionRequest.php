<?php

namespace App\Http\Requests;

use App\Models\BedSizesByRegion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBedSizesByRegionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bed_sizes_by_region_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'size_code' => [
                'string',
                'required',
            ],
            'world_region_id' => [
                'required',
                'integer',
            ],
            'related_size_groups.*' => [
                'integer',
            ],
            'related_size_groups' => [
                'array',
            ],
            'mattress_w_mm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mattress_l_mm' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'imperial_l_ft_in' => [
                'string',
                'nullable',
            ],
            'imperial_w_ft_in' => [
                'string',
                'nullable',
            ],
            'imperial_nickname' => [
                'string',
                'nullable',
            ],
        ];
    }
}
