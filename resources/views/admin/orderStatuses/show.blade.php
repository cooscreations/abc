@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $orderStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderStatus.fields.name') }}
                        </th>
                        <td>
                            {{ $orderStatus->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderStatus.fields.description') }}
                        </th>
                        <td>
                            {{ $orderStatus->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderStatus.fields.list_order') }}
                        </th>
                        <td>
                            {{ $orderStatus->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-statuses.index') }}">
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
            <a class="nav-link" href="#order_status_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_status_orders">
            @includeIf('admin.orderStatuses.relationships.orderStatusOrders', ['orders' => $orderStatus->orderStatusOrders])
        </div>
    </div>
</div>

@endsection