<?php

namespace App\Http\Requests;

use App\Models\CurrencyRate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCurrencyRateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('currency_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:currency_rates,id',
        ];
    }
}
