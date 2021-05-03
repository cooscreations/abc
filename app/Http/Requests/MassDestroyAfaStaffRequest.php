<?php

namespace App\Http\Requests;

use App\Models\AfaStaff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAfaStaffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('afa_staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:afa_staffs,id',
        ];
    }
}
