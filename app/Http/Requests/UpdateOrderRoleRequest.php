<?php

namespace App\Http\Requests;

use App\Models\OrderRole;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_role_edit');
    }

    public function rules()
    {
        return [];
    }
}
