<?php

namespace App\Http\Requests;

use App\Models\CurrencyRate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCurrencyRateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('currency_rate_edit');
    }

    public function rules()
    {
        return [
            'usd_value' => [
                'required',
            ],
            'valid_until' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
