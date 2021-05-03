<?php

namespace App\Http\Requests;

use App\Models\ProductSizeName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductSizeNameRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_size_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_size_names,id',
        ];
    }
}
