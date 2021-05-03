<?php

namespace App\Http\Requests;

use App\Models\Packaging;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePackagingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('packaging_edit');
    }

    public function rules()
    {
        return [];
    }
}
