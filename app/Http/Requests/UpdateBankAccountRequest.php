<?php

namespace App\Http\Requests;

use App\Models\BankAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'bank_name' => [
                'string',
                'nullable',
            ],
            'beneficiary' => [
                'string',
                'nullable',
            ],
            'account_number' => [
                'string',
                'required',
            ],
            'swift_code' => [
                'string',
                'nullable',
            ],
            'tlx_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
