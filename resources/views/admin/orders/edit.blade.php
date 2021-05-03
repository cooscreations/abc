@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="afa_order_num">{{ trans('cruds.order.fields.afa_order_num') }}</label>
                <input class="form-control {{ $errors->has('afa_order_num') ? 'is-invalid' : '' }}" type="text" name="afa_order_num" id="afa_order_num" value="{{ old('afa_order_num', $order->afa_order_num) }}" required>
                @if($errors->has('afa_order_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('afa_order_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.afa_order_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cust_order_date">{{ trans('cruds.order.fields.cust_order_date') }}</label>
                <input class="form-control datetime {{ $errors->has('cust_order_date') ? 'is-invalid' : '' }}" type="text" name="cust_order_date" id="cust_order_date" value="{{ old('cust_order_date', $order->cust_order_date) }}" required>
                @if($errors->has('cust_order_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_order_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.cust_order_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sales_person_id">{{ trans('cruds.order.fields.sales_person') }}</label>
                <select class="form-control select2 {{ $errors->has('sales_person') ? 'is-invalid' : '' }}" name="sales_person_id" id="sales_person_id">
                    @foreach($sales_people as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sales_person_id') ? old('sales_person_id') : $order->sales_person->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sales_person'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sales_person') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.sales_person_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_follower_id">{{ trans('cruds.order.fields.order_follower') }}</label>
                <select class="form-control select2 {{ $errors->has('order_follower') ? 'is-invalid' : '' }}" name="order_follower_id" id="order_follower_id">
                    @foreach($order_followers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_follower_id') ? old('order_follower_id') : $order->order_follower->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_follower'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_follower') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_follower_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_status_id">{{ trans('cruds.order.fields.order_status') }}</label>
                <select class="form-control select2 {{ $errors->has('order_status') ? 'is-invalid' : '' }}" name="order_status_id" id="order_status_id" required>
                    @foreach($order_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_status_id') ? old('order_status_id') : $order->order_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_type_id">{{ trans('cruds.order.fields.order_type') }}</label>
                <select class="form-control select2 {{ $errors->has('order_type') ? 'is-invalid' : '' }}" name="order_type_id" id="order_type_id">
                    @foreach($order_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_type_id') ? old('order_type_id') : $order->order_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_type_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('ukfr') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="ukfr" value="0">
                    <input class="form-check-input" type="checkbox" name="ukfr" id="ukfr" value="1" {{ $order->ukfr || old('ukfr', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ukfr">{{ trans('cruds.order.fields.ukfr') }}</label>
                </div>
                @if($errors->has('ukfr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ukfr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ukfr_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_order_number">{{ trans('cruds.order.fields.customer_order_number') }}</label>
                <input class="form-control {{ $errors->has('customer_order_number') ? 'is-invalid' : '' }}" type="text" name="customer_order_number" id="customer_order_number" value="{{ old('customer_order_number', $order->customer_order_number) }}">
                @if($errors->has('customer_order_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_order_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.order.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $order->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order_placed_by_id">{{ trans('cruds.order.fields.order_placed_by') }}</label>
                <select class="form-control select2 {{ $errors->has('order_placed_by') ? 'is-invalid' : '' }}" name="order_placed_by_id" id="order_placed_by_id" required>
                    @foreach($order_placed_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_placed_by_id') ? old('order_placed_by_id') : $order->order_placed_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_placed_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_placed_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_placed_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_agent_id">{{ trans('cruds.order.fields.shipping_agent') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_agent') ? 'is-invalid' : '' }}" name="shipping_agent_id" id="shipping_agent_id">
                    @foreach($shipping_agents as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shipping_agent_id') ? old('shipping_agent_id') : $order->shipping_agent->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_agent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_agent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_agent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ship_from_port_id">{{ trans('cruds.order.fields.ship_from_port') }}</label>
                <select class="form-control select2 {{ $errors->has('ship_from_port') ? 'is-invalid' : '' }}" name="ship_from_port_id" id="ship_from_port_id">
                    @foreach($ship_from_ports as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ship_from_port_id') ? old('ship_from_port_id') : $order->ship_from_port->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ship_from_port'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ship_from_port') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ship_from_port_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ship_to_port_id">{{ trans('cruds.order.fields.ship_to_port') }}</label>
                <select class="form-control select2 {{ $errors->has('ship_to_port') ? 'is-invalid' : '' }}" name="ship_to_port_id" id="ship_to_port_id">
                    @foreach($ship_to_ports as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ship_to_port_id') ? old('ship_to_port_id') : $order->ship_to_port->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ship_to_port'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ship_to_port') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ship_to_port_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ship_to_address_id">{{ trans('cruds.order.fields.ship_to_address') }}</label>
                <select class="form-control select2 {{ $errors->has('ship_to_address') ? 'is-invalid' : '' }}" name="ship_to_address_id" id="ship_to_address_id">
                    @foreach($ship_to_addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ship_to_address_id') ? old('ship_to_address_id') : $order->ship_to_address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ship_to_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ship_to_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ship_to_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bill_to_address_id">{{ trans('cruds.order.fields.bill_to_address') }}</label>
                <select class="form-control select2 {{ $errors->has('bill_to_address') ? 'is-invalid' : '' }}" name="bill_to_address_id" id="bill_to_address_id">
                    @foreach($bill_to_addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bill_to_address_id') ? old('bill_to_address_id') : $order->bill_to_address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bill_to_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bill_to_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.bill_to_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_value_placed_usd">{{ trans('cruds.order.fields.pi_value_placed_usd') }}</label>
                <input class="form-control {{ $errors->has('pi_value_placed_usd') ? 'is-invalid' : '' }}" type="number" name="pi_value_placed_usd" id="pi_value_placed_usd" value="{{ old('pi_value_placed_usd', $order->pi_value_placed_usd) }}" step="0.01">
                @if($errors->has('pi_value_placed_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_value_placed_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pi_value_placed_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ci_value_shipped_usd">{{ trans('cruds.order.fields.ci_value_shipped_usd') }}</label>
                <input class="form-control {{ $errors->has('ci_value_shipped_usd') ? 'is-invalid' : '' }}" type="number" name="ci_value_shipped_usd" id="ci_value_shipped_usd" value="{{ old('ci_value_shipped_usd', $order->ci_value_shipped_usd) }}" step="0.01">
                @if($errors->has('ci_value_shipped_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ci_value_shipped_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ci_value_shipped_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_deposit_value_usd">{{ trans('cruds.order.fields.customer_deposit_value_usd') }}</label>
                <input class="form-control {{ $errors->has('customer_deposit_value_usd') ? 'is-invalid' : '' }}" type="number" name="customer_deposit_value_usd" id="customer_deposit_value_usd" value="{{ old('customer_deposit_value_usd', $order->customer_deposit_value_usd) }}" step="0.01">
                @if($errors->has('customer_deposit_value_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_deposit_value_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_deposit_value_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_deposit_rate">{{ trans('cruds.order.fields.customer_deposit_rate') }}</label>
                <input class="form-control {{ $errors->has('customer_deposit_rate') ? 'is-invalid' : '' }}" type="number" name="customer_deposit_rate" id="customer_deposit_rate" value="{{ old('customer_deposit_rate', $order->customer_deposit_rate) }}" step="1">
                @if($errors->has('customer_deposit_rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_deposit_rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_deposit_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cust_dep_rec_date">{{ trans('cruds.order.fields.cust_dep_rec_date') }}</label>
                <input class="form-control date {{ $errors->has('cust_dep_rec_date') ? 'is-invalid' : '' }}" type="text" name="cust_dep_rec_date" id="cust_dep_rec_date" value="{{ old('cust_dep_rec_date', $order->cust_dep_rec_date) }}">
                @if($errors->has('cust_dep_rec_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_dep_rec_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.cust_dep_rec_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_sent_to_supplier_date">{{ trans('cruds.order.fields.order_sent_to_supplier_date') }}</label>
                <input class="form-control date {{ $errors->has('order_sent_to_supplier_date') ? 'is-invalid' : '' }}" type="text" name="order_sent_to_supplier_date" id="order_sent_to_supplier_date" value="{{ old('order_sent_to_supplier_date', $order->order_sent_to_supplier_date) }}">
                @if($errors->has('order_sent_to_supplier_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_sent_to_supplier_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_sent_to_supplier_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="allowance_usd">{{ trans('cruds.order.fields.allowance_usd') }}</label>
                <input class="form-control {{ $errors->has('allowance_usd') ? 'is-invalid' : '' }}" type="number" name="allowance_usd" id="allowance_usd" value="{{ old('allowance_usd', $order->allowance_usd) }}" step="0.01">
                @if($errors->has('allowance_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('allowance_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.allowance_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_required_ship_date">{{ trans('cruds.order.fields.customer_required_ship_date') }}</label>
                <input class="form-control date {{ $errors->has('customer_required_ship_date') ? 'is-invalid' : '' }}" type="text" name="customer_required_ship_date" id="customer_required_ship_date" value="{{ old('customer_required_ship_date', $order->customer_required_ship_date) }}">
                @if($errors->has('customer_required_ship_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_required_ship_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_required_ship_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="crd_target_date">{{ trans('cruds.order.fields.crd_target_date') }}</label>
                <input class="form-control date {{ $errors->has('crd_target_date') ? 'is-invalid' : '' }}" type="text" name="crd_target_date" id="crd_target_date" value="{{ old('crd_target_date', $order->crd_target_date) }}">
                @if($errors->has('crd_target_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('crd_target_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.crd_target_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quality_control_staffs">{{ trans('cruds.order.fields.quality_control_staff') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('quality_control_staffs') ? 'is-invalid' : '' }}" name="quality_control_staffs[]" id="quality_control_staffs" multiple>
                    @foreach($quality_control_staffs as $id => $quality_control_staff)
                        <option value="{{ $id }}" {{ (in_array($id, old('quality_control_staffs', [])) || $order->quality_control_staffs->contains($id)) ? 'selected' : '' }}>{{ $quality_control_staff }}</option>
                    @endforeach
                </select>
                @if($errors->has('quality_control_staffs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quality_control_staffs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.quality_control_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_date">{{ trans('cruds.order.fields.booking_date') }}</label>
                <input class="form-control date {{ $errors->has('booking_date') ? 'is-invalid' : '' }}" type="text" name="booking_date" id="booking_date" value="{{ old('booking_date', $order->booking_date) }}">
                @if($errors->has('booking_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.booking_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="so_date">{{ trans('cruds.order.fields.so_date') }}</label>
                <input class="form-control date {{ $errors->has('so_date') ? 'is-invalid' : '' }}" type="text" name="so_date" id="so_date" value="{{ old('so_date', $order->so_date) }}">
                @if($errors->has('so_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('so_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.so_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_balance_usd">{{ trans('cruds.order.fields.customer_balance_usd') }}</label>
                <input class="form-control {{ $errors->has('customer_balance_usd') ? 'is-invalid' : '' }}" type="number" name="customer_balance_usd" id="customer_balance_usd" value="{{ old('customer_balance_usd', $order->customer_balance_usd) }}" step="0.01">
                @if($errors->has('customer_balance_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_balance_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_balance_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_received_date">{{ trans('cruds.order.fields.balance_received_date') }}</label>
                <input class="form-control date {{ $errors->has('balance_received_date') ? 'is-invalid' : '' }}" type="text" name="balance_received_date" id="balance_received_date" value="{{ old('balance_received_date', $order->balance_received_date) }}">
                @if($errors->has('balance_received_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_received_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.balance_received_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supplier_id">{{ trans('cruds.order.fields.supplier') }}</label>
                <select class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                    @foreach($suppliers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('supplier_id') ? old('supplier_id') : $order->supplier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('supplier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="po_value_placed_usd">{{ trans('cruds.order.fields.po_value_placed_usd') }}</label>
                <input class="form-control {{ $errors->has('po_value_placed_usd') ? 'is-invalid' : '' }}" type="number" name="po_value_placed_usd" id="po_value_placed_usd" value="{{ old('po_value_placed_usd', $order->po_value_placed_usd) }}" step="0.01">
                @if($errors->has('po_value_placed_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('po_value_placed_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.po_value_placed_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="po_value_shipped_usd">{{ trans('cruds.order.fields.po_value_shipped_usd') }}</label>
                <input class="form-control {{ $errors->has('po_value_shipped_usd') ? 'is-invalid' : '' }}" type="number" name="po_value_shipped_usd" id="po_value_shipped_usd" value="{{ old('po_value_shipped_usd', $order->po_value_shipped_usd) }}" step="0.01">
                @if($errors->has('po_value_shipped_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('po_value_shipped_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.po_value_shipped_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supplier_deposit_usd">{{ trans('cruds.order.fields.supplier_deposit_usd') }}</label>
                <input class="form-control {{ $errors->has('supplier_deposit_usd') ? 'is-invalid' : '' }}" type="number" name="supplier_deposit_usd" id="supplier_deposit_usd" value="{{ old('supplier_deposit_usd', $order->supplier_deposit_usd) }}" step="0.01">
                @if($errors->has('supplier_deposit_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_deposit_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.supplier_deposit_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supplier_deposit_paid_date">{{ trans('cruds.order.fields.supplier_deposit_paid_date') }}</label>
                <input class="form-control date {{ $errors->has('supplier_deposit_paid_date') ? 'is-invalid' : '' }}" type="text" name="supplier_deposit_paid_date" id="supplier_deposit_paid_date" value="{{ old('supplier_deposit_paid_date', $order->supplier_deposit_paid_date) }}">
                @if($errors->has('supplier_deposit_paid_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_deposit_paid_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.supplier_deposit_paid_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="handling_charge_and_allowance_usd">{{ trans('cruds.order.fields.handling_charge_and_allowance_usd') }}</label>
                <input class="form-control {{ $errors->has('handling_charge_and_allowance_usd') ? 'is-invalid' : '' }}" type="number" name="handling_charge_and_allowance_usd" id="handling_charge_and_allowance_usd" value="{{ old('handling_charge_and_allowance_usd', $order->handling_charge_and_allowance_usd) }}" step="0.01">
                @if($errors->has('handling_charge_and_allowance_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('handling_charge_and_allowance_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.handling_charge_and_allowance_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documents_received_date">{{ trans('cruds.order.fields.documents_received_date') }}</label>
                <input class="form-control date {{ $errors->has('documents_received_date') ? 'is-invalid' : '' }}" type="text" name="documents_received_date" id="documents_received_date" value="{{ old('documents_received_date', $order->documents_received_date) }}">
                @if($errors->has('documents_received_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documents_received_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.documents_received_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supplier_balance_usd">{{ trans('cruds.order.fields.supplier_balance_usd') }}</label>
                <input class="form-control {{ $errors->has('supplier_balance_usd') ? 'is-invalid' : '' }}" type="number" name="supplier_balance_usd" id="supplier_balance_usd" value="{{ old('supplier_balance_usd', $order->supplier_balance_usd) }}" step="0.01">
                @if($errors->has('supplier_balance_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_balance_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.supplier_balance_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supplier_balance_paid_date">{{ trans('cruds.order.fields.supplier_balance_paid_date') }}</label>
                <input class="form-control date {{ $errors->has('supplier_balance_paid_date') ? 'is-invalid' : '' }}" type="text" name="supplier_balance_paid_date" id="supplier_balance_paid_date" value="{{ old('supplier_balance_paid_date', $order->supplier_balance_paid_date) }}">
                @if($errors->has('supplier_balance_paid_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_balance_paid_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.supplier_balance_paid_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commission_usd">{{ trans('cruds.order.fields.commission_usd') }}</label>
                <input class="form-control {{ $errors->has('commission_usd') ? 'is-invalid' : '' }}" type="number" name="commission_usd" id="commission_usd" value="{{ old('commission_usd', $order->commission_usd) }}" step="0.01">
                @if($errors->has('commission_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commission_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.commission_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commission_paid_date">{{ trans('cruds.order.fields.commission_paid_date') }}</label>
                <input class="form-control date {{ $errors->has('commission_paid_date') ? 'is-invalid' : '' }}" type="text" name="commission_paid_date" id="commission_paid_date" value="{{ old('commission_paid_date', $order->commission_paid_date) }}">
                @if($errors->has('commission_paid_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commission_paid_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.commission_paid_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="packaging_type_id">{{ trans('cruds.order.fields.packaging_type') }}</label>
                <select class="form-control select2 {{ $errors->has('packaging_type') ? 'is-invalid' : '' }}" name="packaging_type_id" id="packaging_type_id">
                    @foreach($packaging_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('packaging_type_id') ? old('packaging_type_id') : $order->packaging_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('packaging_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('packaging_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.packaging_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="req_fumigtion">{{ trans('cruds.order.fields.req_fumigtion') }}</label>
                <input class="form-control {{ $errors->has('req_fumigtion') ? 'is-invalid' : '' }}" type="text" name="req_fumigtion" id="req_fumigtion" value="{{ old('req_fumigtion', $order->req_fumigtion) }}">
                @if($errors->has('req_fumigtion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('req_fumigtion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.req_fumigtion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fumigation_cost_usd">{{ trans('cruds.order.fields.fumigation_cost_usd') }}</label>
                <input class="form-control {{ $errors->has('fumigation_cost_usd') ? 'is-invalid' : '' }}" type="number" name="fumigation_cost_usd" id="fumigation_cost_usd" value="{{ old('fumigation_cost_usd', $order->fumigation_cost_usd) }}" step="0.01">
                @if($errors->has('fumigation_cost_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fumigation_cost_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.fumigation_cost_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profit_usd">{{ trans('cruds.order.fields.profit_usd') }}</label>
                <input class="form-control {{ $errors->has('profit_usd') ? 'is-invalid' : '' }}" type="number" name="profit_usd" id="profit_usd" value="{{ old('profit_usd', $order->profit_usd) }}" step="0.01">
                @if($errors->has('profit_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profit_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.profit_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profit_ratio">{{ trans('cruds.order.fields.profit_ratio') }}</label>
                <input class="form-control {{ $errors->has('profit_ratio') ? 'is-invalid' : '' }}" type="number" name="profit_ratio" id="profit_ratio" value="{{ old('profit_ratio', $order->profit_ratio) }}" step="0.01" max="100">
                @if($errors->has('profit_ratio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profit_ratio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.profit_ratio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fn_audit_complete_date">{{ trans('cruds.order.fields.fn_audit_complete_date') }}</label>
                <input class="form-control date {{ $errors->has('fn_audit_complete_date') ? 'is-invalid' : '' }}" type="text" name="fn_audit_complete_date" id="fn_audit_complete_date" value="{{ old('fn_audit_complete_date', $order->fn_audit_complete_date) }}">
                @if($errors->has('fn_audit_complete_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fn_audit_complete_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.fn_audit_complete_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_days_to_complete">{{ trans('cruds.order.fields.total_days_to_complete') }}</label>
                <input class="form-control {{ $errors->has('total_days_to_complete') ? 'is-invalid' : '' }}" type="number" name="total_days_to_complete" id="total_days_to_complete" value="{{ old('total_days_to_complete', $order->total_days_to_complete) }}" step="1">
                @if($errors->has('total_days_to_complete'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_days_to_complete') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.total_days_to_complete_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_tolerance">{{ trans('cruds.order.fields.qty_tolerance') }}</label>
                <input class="form-control {{ $errors->has('qty_tolerance') ? 'is-invalid' : '' }}" type="number" name="qty_tolerance" id="qty_tolerance" value="{{ old('qty_tolerance', $order->qty_tolerance) }}" step="1">
                @if($errors->has('qty_tolerance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_tolerance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.qty_tolerance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="size_tolerance">{{ trans('cruds.order.fields.size_tolerance') }}</label>
                <input class="form-control {{ $errors->has('size_tolerance') ? 'is-invalid' : '' }}" type="number" name="size_tolerance" id="size_tolerance" value="{{ old('size_tolerance', $order->size_tolerance) }}" step="1">
                @if($errors->has('size_tolerance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size_tolerance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.size_tolerance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leadtime_days">{{ trans('cruds.order.fields.leadtime_days') }}</label>
                <input class="form-control {{ $errors->has('leadtime_days') ? 'is-invalid' : '' }}" type="text" name="leadtime_days" id="leadtime_days" value="{{ old('leadtime_days', $order->leadtime_days) }}">
                @if($errors->has('leadtime_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leadtime_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.leadtime_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cny_to_usd_rate_today">{{ trans('cruds.order.fields.cny_to_usd_rate_today') }}</label>
                <input class="form-control {{ $errors->has('cny_to_usd_rate_today') ? 'is-invalid' : '' }}" type="number" name="cny_to_usd_rate_today" id="cny_to_usd_rate_today" value="{{ old('cny_to_usd_rate_today', $order->cny_to_usd_rate_today) }}" step="0.01">
                @if($errors->has('cny_to_usd_rate_today'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cny_to_usd_rate_today') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.cny_to_usd_rate_today_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price_expiry_date">{{ trans('cruds.order.fields.price_expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('price_expiry_date') ? 'is-invalid' : '' }}" type="text" name="price_expiry_date" id="price_expiry_date" value="{{ old('price_expiry_date', $order->price_expiry_date) }}">
                @if($errors->has('price_expiry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_expiry_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.price_expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="afa_bank_account_to_pay_id">{{ trans('cruds.order.fields.afa_bank_account_to_pay') }}</label>
                <select class="form-control select2 {{ $errors->has('afa_bank_account_to_pay') ? 'is-invalid' : '' }}" name="afa_bank_account_to_pay_id" id="afa_bank_account_to_pay_id">
                    @foreach($afa_bank_account_to_pays as $id => $entry)
                        <option value="{{ $id }}" {{ (old('afa_bank_account_to_pay_id') ? old('afa_bank_account_to_pay_id') : $order->afa_bank_account_to_pay->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('afa_bank_account_to_pay'))
                    <div class="invalid-feedback">
                        {{ $errors->first('afa_bank_account_to_pay') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.afa_bank_account_to_pay_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection