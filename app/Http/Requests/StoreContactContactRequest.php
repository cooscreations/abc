<?php

namespace App\Http\Requests;

use App\Models\ContactContact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_contact_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'contact_first_name' => [
                'string',
                'nullable',
            ],
            'contact_last_name' => [
                'string',
                'nullable',
            ],
            'full_name' => [
                'string',
                'nullable',
            ],
            'local_name' => [
                'string',
                'nullable',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
            'wechat' => [
                'string',
                'nullable',
            ],
            'linkedin_url' => [
                'string',
                'nullable',
            ],
            'facebook_url' => [
                'string',
                'nullable',
            ],
            'contact_email' => [
                'string',
                'nullable',
            ],
            'personal_email' => [
                'string',
                'nullable',
            ],
            'office_phone' => [
                'string',
                'nullable',
            ],
            'mobile_phone' => [
                'string',
                'nullable',
            ],
            'personal_url' => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'array',
            ],
            'nda_signed_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'honesty_agreement_signed_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
