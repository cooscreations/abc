@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.order.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.afa_order_num') }}
                        </th>
                        <td>
                            {{ $order->afa_order_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.cust_order_date') }}
                        </th>
                        <td>
                            {{ $order->cust_order_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.sales_person') }}
                        </th>
                        <td>
                            {{ $order->sales_person->contact_first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_follower') }}
                        </th>
                        <td>
                            {{ $order->order_follower->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_status') }}
                        </th>
                        <td>
                            {{ $order->order_status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_type') }}
                        </th>
                        <td>
                            {{ $order->order_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.ukfr') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $order->ukfr ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_order_number') }}
                        </th>
                        <td>
                            {{ $order->customer_order_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <td>
                            {{ $order->customer->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_placed_by') }}
                        </th>
                        <td>
                            {{ $order->order_placed_by->contact_first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.shipping_agent') }}
                        </th>
                        <td>
                            {{ $order->shipping_agent->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.ship_from_port') }}
                        </th>
                        <td>
                            {{ $order->ship_from_port->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.ship_to_port') }}
                        </th>
                        <td>
                            {{ $order->ship_to_port->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.ship_to_address') }}
                        </th>
                        <td>
                            {{ $order->ship_to_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.bill_to_address') }}
                        </th>
                        <td>
                            {{ $order->bill_to_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.pi_value_placed_usd') }}
                        </th>
                        <td>
                            {{ $order->pi_value_placed_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.ci_value_shipped_usd') }}
                        </th>
                        <td>
                            {{ $order->ci_value_shipped_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_deposit_rate') }}
                        </th>
                        <td>
                            {{ $order->customer_deposit_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.cust_dep_rec_date') }}
                        </th>
                        <td>
                            {{ $order->cust_dep_rec_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_sent_to_supplier_date') }}
                        </th>
                        <td>
                            {{ $order->order_sent_to_supplier_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.allowance_usd') }}
                        </th>
                        <td>
                            {{ $order->allowance_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_required_ship_date') }}
                        </th>
                        <td>
                            {{ $order->customer_required_ship_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.crd_target_date') }}
                        </th>
                        <td>
                            {{ $order->crd_target_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.quality_control_staff') }}
                        </th>
                        <td>
                            @foreach($order->quality_control_staffs as $key => $quality_control_staff)
                                <span class="label label-info">{{ $quality_control_staff->full_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.booking_date') }}
                        </th>
                        <td>
                            {{ $order->booking_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.so_date') }}
                        </th>
                        <td>
                            {{ $order->so_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_balance_usd') }}
                        </th>
                        <td>
                            {{ $order->customer_balance_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.balance_received_date') }}
                        </th>
                        <td>
                            {{ $order->balance_received_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.supplier') }}
                        </th>
                        <td>
                            {{ $order->supplier->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.po_value_placed_usd') }}
                        </th>
                        <td>
                            {{ $order->po_value_placed_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.po_value_shipped_usd') }}
                        </th>
                        <td>
                            {{ $order->po_value_shipped_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.supplier_deposit_usd') }}
                        </th>
                        <td>
                            {{ $order->supplier_deposit_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.supplier_deposit_paid_date') }}
                        </th>
                        <td>
                            {{ $order->supplier_deposit_paid_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.handling_charge_and_allowance_usd') }}
                        </th>
                        <td>
                            {{ $order->handling_charge_and_allowance_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.documents_received_date') }}
                        </th>
                        <td>
                            {{ $order->documents_received_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.supplier_balance_usd') }}
                        </th>
                        <td>
                            {{ $order->supplier_balance_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.supplier_balance_paid_date') }}
                        </th>
                        <td>
                            {{ $order->supplier_balance_paid_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.commission_usd') }}
                        </th>
                        <td>
                            {{ $order->commission_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.commission_paid_date') }}
                        </th>
                        <td>
                            {{ $order->commission_paid_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.packaging_type') }}
                        </th>
                        <td>
                            {{ $order->packaging_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.req_fumigtion') }}
                        </th>
                        <td>
                            {{ $order->req_fumigtion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.fumigation_cost_usd') }}
                        </th>
                        <td>
                            {{ $order->fumigation_cost_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.profit_usd') }}
                        </th>
                        <td>
                            {{ $order->profit_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.profit_ratio') }}
                        </th>
                        <td>
                            {{ $order->profit_ratio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.fn_audit_complete_date') }}
                        </th>
                        <td>
                            {{ $order->fn_audit_complete_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.total_days_to_complete') }}
                        </th>
                        <td>
                            {{ $order->total_days_to_complete }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.qty_tolerance') }}
                        </th>
                        <td>
                            {{ $order->qty_tolerance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.size_tolerance') }}
                        </th>
                        <td>
                            {{ $order->size_tolerance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.leadtime_days') }}
                        </th>
                        <td>
                            {{ $order->leadtime_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.cny_to_usd_rate_today') }}
                        </th>
                        <td>
                            {{ $order->cny_to_usd_rate_today }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.price_expiry_date') }}
                        </th>
                        <td>
                            {{ $order->price_expiry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.afa_bank_account_to_pay') }}
                        </th>
                        <td>
                            {{ $order->afa_bank_account_to_pay->bank_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
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
            <a class="nav-link" href="#order_order_items" role="tab" data-toggle="tab">
                {{ trans('cruds.orderItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_shipping_containers" role="tab" data-toggle="tab">
                {{ trans('cruds.shippingContainer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_order_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.orderRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_orders_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_order_items">
            @includeIf('admin.orders.relationships.orderOrderItems', ['orderItems' => $order->orderOrderItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_shipping_containers">
            @includeIf('admin.orders.relationships.orderShippingContainers', ['shippingContainers' => $order->orderShippingContainers])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_order_roles">
            @includeIf('admin.orders.relationships.orderOrderRoles', ['orderRoles' => $order->orderOrderRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_inspections">
            @includeIf('admin.orders.relationships.orderInspections', ['inspections' => $order->orderInspections])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_incomes">
            @includeIf('admin.orders.relationships.orderIncomes', ['incomes' => $order->orderIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_orders_documents">
            @includeIf('admin.orders.relationships.relatedOrdersDocuments', ['documents' => $order->relatedOrdersDocuments])
        </div>
    </div>
</div>

@endsection