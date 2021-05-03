<?php

namespace App\Http\Requests;

use App\Models\ContactCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_company_edit');
    }

    public function rules()
    {
        return [
            'company_short_code' => [
                'string',
                'nullable',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'company_website' => [
                'string',
                'nullable',
            ],
            'company_email' => [
                'string',
                'nullable',
            ],
            'primary_company_type_id' => [
                'required',
                'integer',
            ],
            'reg_country_id' => [
                'required',
                'integer',
            ],
            'formal_reg_name' => [
                'string',
                'nullable',
            ],
            'local_name' => [
                'string',
                'nullable',
            ],
            'company_reg_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'company_reg_num' => [
                'string',
                'nullable',
            ],
            'company_reg_expiry' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'export_license_num' => [
                'string',
                'nullable',
            ],
            'import_license_num' => [
                'string',
                'nullable',
            ],
            'addresses.*' => [
                'integer',
            ],
            'addresses' => [
                'array',
            ],
        ];
    }
}
