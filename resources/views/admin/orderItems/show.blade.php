@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.id') }}
                        </th>
                        <td>
                            {{ $orderItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.order') }}
                        </th>
                        <td>
                            {{ $orderItem->order->afa_order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.quantity') }}
                        </th>
                        <td>
                            {{ $orderItem->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product') }}
                        </th>
                        <td>
                            {{ $orderItem->product->afa_model_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_sku') }}
                        </th>
                        <td>
                            {{ $orderItem->product_sku->product_sku ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-items.index') }}">
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
            <a class="nav-link" href="#order_item_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_item_inspections">
            @includeIf('admin.orderItems.relationships.orderItemInspections', ['inspections' => $orderItem->orderItemInspections])
        </div>
    </div>
</div>

@endsection