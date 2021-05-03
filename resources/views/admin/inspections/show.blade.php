@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.inspection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inspections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.id') }}
                        </th>
                        <td>
                            {{ $inspection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.order') }}
                        </th>
                        <td>
                            {{ $inspection->order->afa_order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.afa_order_number') }}
                        </th>
                        <td>
                            {{ $inspection->afa_order_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.inspector_name') }}
                        </th>
                        <td>
                            {{ $inspection->inspector_name->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.customer') }}
                        </th>
                        <td>
                            {{ $inspection->customer->company_short_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.customer_order_number') }}
                        </th>
                        <td>
                            {{ $inspection->customer_order_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.order_follower') }}
                        </th>
                        <td>
                            {{ $inspection->order_follower->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.supplier') }}
                        </th>
                        <td>
                            {{ $inspection->supplier->company_short_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.order_item') }}
                        </th>
                        <td>
                            {{ $inspection->order_item->quantity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qc_status') }}
                        </th>
                        <td>
                            {{ $inspection->qc_status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qty_inspected') }}
                        </th>
                        <td>
                            {{ $inspection->qty_inspected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.inspection_passed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $inspection->inspection_passed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.inspection_planned_date') }}
                        </th>
                        <td>
                            {{ $inspection->inspection_planned_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.actual_start_date') }}
                        </th>
                        <td>
                            {{ $inspection->actual_start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.crd_inspection_complete_date') }}
                        </th>
                        <td>
                            {{ $inspection->crd_inspection_complete_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.total_days_inspection_open') }}
                        </th>
                        <td>
                            {{ $inspection->total_days_inspection_open }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.total_days_on_site') }}
                        </th>
                        <td>
                            {{ $inspection->total_days_on_site }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.additional_q_cs') }}
                        </th>
                        <td>
                            @foreach($inspection->additional_q_cs as $key => $additional_q_cs)
                                <span class="label label-info">{{ $additional_q_cs->full_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qc_report_received') }}
                        </th>
                        <td>
                            {{ $inspection->qc_report_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qe_audit_complete_date') }}
                        </th>
                        <td>
                            {{ $inspection->qe_audit_complete_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qc_report_sent_to_customer_date') }}
                        </th>
                        <td>
                            {{ $inspection->qc_report_sent_to_customer_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.sharepoint_photos_url') }}
                        </th>
                        <td>
                            {{ $inspection->sharepoint_photos_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.fabric_received_date') }}
                        </th>
                        <td>
                            {{ $inspection->fabric_received_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.inspector_private_notes') }}
                        </th>
                        <td>
                            {{ $inspection->inspector_private_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.public_notes') }}
                        </th>
                        <td>
                            {{ $inspection->public_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspection.fields.qc_paid_date') }}
                        </th>
                        <td>
                            {{ $inspection->qc_paid_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inspections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection