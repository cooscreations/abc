<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'cust_order_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'New Order #',
            'suffix'     => 'was placed today',
            'route'      => 'admin.orders.edit',
        ],
        [
            'model'      => '\App\Models\Inspection',
            'date_field' => 'inspection_planned_date',
            'field'      => 'afa_order_number',
            'prefix'     => 'Order #',
            'suffix'     => 'SHOULD be inspected today',
            'route'      => 'admin.inspections.edit',
        ],
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'customer_required_ship_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'Order #',
            'suffix'     => 'is required to ship today',
            'route'      => 'admin.orders.edit',
        ],
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'crd_target_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'Order #',
            'suffix'     => 'cargo ready date (C.R.D.)',
            'route'      => 'admin.orders.edit',
        ],
        [
            'model'      => '\App\Models\Inspection',
            'date_field' => 'actual_start_date',
            'field'      => 'afa_order_number',
            'prefix'     => 'Order #',
            'suffix'     => 'started today (ACTUAL)',
            'route'      => 'admin.inspections.edit',
        ],
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'so_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'Order #',
            'suffix'     => 'S.O. Date',
            'route'      => 'admin.orders.edit',
        ],
        [
            'model'      => '\App\Models\ContactContact',
            'date_field' => 'date_of_birth',
            'field'      => 'full_name',
            'prefix'     => 'BIRTHDAY!:',
            'suffix'     => '',
            'route'      => 'admin.contact-contacts.edit',
        ],
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'balance_received_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'Order #:',
            'suffix'     => 'balance CONFIRMED received today',
            'route'      => 'admin.orders.edit',
        ],
        [
            'model'      => '\App\Models\Order',
            'date_field' => 'fn_audit_complete_date',
            'field'      => 'afa_order_num',
            'prefix'     => 'Order # :',
            'suffix'     => 'FN Audit Completed today',
            'route'      => 'admin.orders.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
