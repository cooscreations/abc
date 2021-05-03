<?php

namespace App\Http\Requests;

use App\Models\Packaging;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackagingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('packaging_create');
    }

    public function rules()
    {
        return [];
    }
}
