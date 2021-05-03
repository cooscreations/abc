<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductSkuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_sku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_skus,id',
        ];
    }
}
