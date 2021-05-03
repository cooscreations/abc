<?php

namespace App\Http\Requests;

use App\Models\WorldRegion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorldRegionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('world_region_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'wiki_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
