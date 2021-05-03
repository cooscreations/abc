<?php

namespace App\Http\Requests;

use App\Models\ShippingContainer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShippingContainerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_container_create');
    }

    public function rules()
    {
        return [
            'container_number' => [
                'string',
                'required',
            ],
            'est_loading_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'actual_loading_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'booking_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'so_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'si_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'estimated_time_of_departure' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'eta' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'copy_bl_rec_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'docs_sent_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'bl_release_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
