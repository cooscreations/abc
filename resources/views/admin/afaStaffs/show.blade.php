@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.afaStaff.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.afa-staffs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.id') }}
                        </th>
                        <td>
                            {{ $afaStaff->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.full_name') }}
                        </th>
                        <td>
                            {{ $afaStaff->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.user') }}
                        </th>
                        <td>
                            {{ $afaStaff->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.staff_level') }}
                        </th>
                        <td>
                            {{ $afaStaff->staff_level->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.reports_to') }}
                        </th>
                        <td>
                            {{ $afaStaff->reports_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.date_started') }}
                        </th>
                        <td>
                            {{ $afaStaff->date_started }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.date_finished') }}
                        </th>
                        <td>
                            {{ $afaStaff->date_finished }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.staff_bio') }}
                        </th>
                        <td>
                            {{ $afaStaff->staff_bio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.afaStaff.fields.department') }}
                        </th>
                        <td>
                            {{ $afaStaff->department->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.afa-staffs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#inspector_name_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_follower_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_follower_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#quality_control_staff_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#additional_q_cs_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="inspector_name_inspections">
            @includeIf('admin.afaStaffs.relationships.inspectorNameInspections', ['inspections' => $afaStaff->inspectorNameInspections])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_follower_orders">
            @includeIf('admin.afaStaffs.relationships.orderFollowerOrders', ['orders' => $afaStaff->orderFollowerOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_follower_inspections">
            @includeIf('admin.afaStaffs.relationships.orderFollowerInspections', ['inspections' => $afaStaff->orderFollowerInspections])
        </div>
        <div class="tab-pane" role="tabpanel" id="quality_control_staff_orders">
            @includeIf('admin.afaStaffs.relationships.qualityControlStaffOrders', ['orders' => $afaStaff->qualityControlStaffOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="additional_q_cs_inspections">
            @includeIf('admin.afaStaffs.relationships.additionalQCsInspections', ['inspections' => $afaStaff->additionalQCsInspections])
        </div>
    </div>
</div>

@endsection