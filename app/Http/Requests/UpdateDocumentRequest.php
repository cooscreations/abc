<?php

namespace App\Http\Requests;

use App\Models\Document;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('document_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'related_orders.*' => [
                'integer',
            ],
            'related_orders' => [
                'array',
            ],
            'related_products.*' => [
                'integer',
            ],
            'related_products' => [
                'array',
            ],
            'related_skus.*' => [
                'integer',
            ],
            'related_skus' => [
                'array',
            ],
            'related_users.*' => [
                'integer',
            ],
            'related_users' => [
                'array',
            ],
            'related_companies.*' => [
                'integer',
            ],
            'related_companies' => [
                'array',
            ],
            'related_contacts.*' => [
                'integer',
            ],
            'related_contacts' => [
                'array',
            ],
            'authorised_user_types.*' => [
                'integer',
            ],
            'authorised_user_types' => [
                'array',
            ],
        ];
    }
}
