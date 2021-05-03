<?php

namespace App\Http\Requests;

use App\Models\OrderRole;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_role_create');
    }

    public function rules()
    {
        return [];
    }
}
