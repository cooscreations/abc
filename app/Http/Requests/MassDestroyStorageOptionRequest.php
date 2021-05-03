<?php

namespace App\Http\Requests;

use App\Models\StorageOption;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStorageOptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('storage_option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:storage_options,id',
        ];
    }
}
