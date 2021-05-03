@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.inspection.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.inspections.update", [$inspection->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="order_id">{{ trans('cruds.inspection.fields.order') }}</label>
                            <select class="form-control select2" name="order_id" id="order_id">
                                @foreach($orders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $inspection->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="afa_order_number">{{ trans('cruds.inspection.fields.afa_order_number') }}</label>
                            <input class="form-control" type="text" name="afa_order_number" id="afa_order_number" value="{{ old('afa_order_number', $inspection->afa_order_number) }}">
                            @if($errors->has('afa_order_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('afa_order_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.afa_order_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="inspector_name_id">{{ trans('cruds.inspection.fields.inspector_name') }}</label>
                            <select class="form-control select2" name="inspector_name_id" id="inspector_name_id" required>
                                @foreach($inspector_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('inspector_name_id') ? old('inspector_name_id') : $inspection->inspector_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('inspector_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inspector_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.inspector_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="customer_id">{{ trans('cruds.inspection.fields.customer') }}</label>
                            <select class="form-control select2" name="customer_id" id="customer_id" required>
                                @foreach($customers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $inspection->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.customer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="customer_order_number">{{ trans('cruds.inspection.fields.customer_order_number') }}</label>
                            <input class="form-control" type="text" name="customer_order_number" id="customer_order_number" value="{{ old('customer_order_number', $inspection->customer_order_number) }}">
                            @if($errors->has('customer_order_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer_order_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.customer_order_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order_follower_id">{{ trans('cruds.inspection.fields.order_follower') }}</label>
                            <select class="form-control select2" name="order_follower_id" id="order_follower_id">
                                @foreach($order_followers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('order_follower_id') ? old('order_follower_id') : $inspection->order_follower->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order_follower'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_follower') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.order_follower_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="supplier_id">{{ trans('cruds.inspection.fields.supplier') }}</label>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" required>
                                @foreach($suppliers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('supplier_id') ? old('supplier_id') : $inspection->supplier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('supplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.supplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order_item_id">{{ trans('cruds.inspection.fields.order_item') }}</label>
                            <select class="form-control select2" name="order_item_id" id="order_item_id">
                                @foreach($order_items as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('order_item_id') ? old('order_item_id') : $inspection->order_item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order_item'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_item') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.order_item_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qc_status_id">{{ trans('cruds.inspection.fields.qc_status') }}</label>
                            <select class="form-control select2" name="qc_status_id" id="qc_status_id">
                                @foreach($qc_statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('qc_status_id') ? old('qc_status_id') : $inspection->qc_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('qc_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qc_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qc_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="qty_inspected">{{ trans('cruds.inspection.fields.qty_inspected') }}</label>
                            <input class="form-control" type="number" name="qty_inspected" id="qty_inspected" value="{{ old('qty_inspected', $inspection->qty_inspected) }}" step="1" required>
                            @if($errors->has('qty_inspected'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty_inspected') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qty_inspected_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="inspection_passed" id="inspection_passed" value="1" {{ $inspection->inspection_passed || old('inspection_passed', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="inspection_passed">{{ trans('cruds.inspection.fields.inspection_passed') }}</label>
                            </div>
                            @if($errors->has('inspection_passed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inspection_passed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.inspection_passed_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inspection_planned_date">{{ trans('cruds.inspection.fields.inspection_planned_date') }}</label>
                            <input class="form-control date" type="text" name="inspection_planned_date" id="inspection_planned_date" value="{{ old('inspection_planned_date', $inspection->inspection_planned_date) }}">
                            @if($errors->has('inspection_planned_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inspection_planned_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.inspection_planned_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="actual_start_date">{{ trans('cruds.inspection.fields.actual_start_date') }}</label>
                            <input class="form-control date" type="text" name="actual_start_date" id="actual_start_date" value="{{ old('actual_start_date', $inspection->actual_start_date) }}">
                            @if($errors->has('actual_start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('actual_start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.actual_start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="crd_inspection_complete_date">{{ trans('cruds.inspection.fields.crd_inspection_complete_date') }}</label>
                            <input class="form-control date" type="text" name="crd_inspection_complete_date" id="crd_inspection_complete_date" value="{{ old('crd_inspection_complete_date', $inspection->crd_inspection_complete_date) }}">
                            @if($errors->has('crd_inspection_complete_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('crd_inspection_complete_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.crd_inspection_complete_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_days_inspection_open">{{ trans('cruds.inspection.fields.total_days_inspection_open') }}</label>
                            <input class="form-control" type="number" name="total_days_inspection_open" id="total_days_inspection_open" value="{{ old('total_days_inspection_open', $inspection->total_days_inspection_open) }}" step="1">
                            @if($errors->has('total_days_inspection_open'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_days_inspection_open') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.total_days_inspection_open_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_days_on_site">{{ trans('cruds.inspection.fields.total_days_on_site') }}</label>
                            <input class="form-control" type="number" name="total_days_on_site" id="total_days_on_site" value="{{ old('total_days_on_site', $inspection->total_days_on_site) }}" step="1">
                            @if($errors->has('total_days_on_site'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_days_on_site') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.total_days_on_site_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_q_cs">{{ trans('cruds.inspection.fields.additional_q_cs') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="additional_q_cs[]" id="additional_q_cs" multiple>
                                @foreach($additional_q_cs as $id => $additional_q_cs)
                                    <option value="{{ $id }}" {{ (in_array($id, old('additional_q_cs', [])) || $inspection->additional_q_cs->contains($id)) ? 'selected' : '' }}>{{ $additional_q_cs }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('additional_q_cs'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('additional_q_cs') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.additional_q_cs_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qc_report_received">{{ trans('cruds.inspection.fields.qc_report_received') }}</label>
                            <input class="form-control date" type="text" name="qc_report_received" id="qc_report_received" value="{{ old('qc_report_received', $inspection->qc_report_received) }}">
                            @if($errors->has('qc_report_received'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qc_report_received') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qc_report_received_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qe_audit_complete_date">{{ trans('cruds.inspection.fields.qe_audit_complete_date') }}</label>
                            <input class="form-control date" type="text" name="qe_audit_complete_date" id="qe_audit_complete_date" value="{{ old('qe_audit_complete_date', $inspection->qe_audit_complete_date) }}">
                            @if($errors->has('qe_audit_complete_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qe_audit_complete_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qe_audit_complete_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qc_report_sent_to_customer_date">{{ trans('cruds.inspection.fields.qc_report_sent_to_customer_date') }}</label>
                            <input class="form-control date" type="text" name="qc_report_sent_to_customer_date" id="qc_report_sent_to_customer_date" value="{{ old('qc_report_sent_to_customer_date', $inspection->qc_report_sent_to_customer_date) }}">
                            @if($errors->has('qc_report_sent_to_customer_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qc_report_sent_to_customer_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qc_report_sent_to_customer_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sharepoint_photos_url">{{ trans('cruds.inspection.fields.sharepoint_photos_url') }}</label>
                            <input class="form-control" type="text" name="sharepoint_photos_url" id="sharepoint_photos_url" value="{{ old('sharepoint_photos_url', $inspection->sharepoint_photos_url) }}">
                            @if($errors->has('sharepoint_photos_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sharepoint_photos_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.sharepoint_photos_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fabric_received_date">{{ trans('cruds.inspection.fields.fabric_received_date') }}</label>
                            <input class="form-control date" type="text" name="fabric_received_date" id="fabric_received_date" value="{{ old('fabric_received_date', $inspection->fabric_received_date) }}">
                            @if($errors->has('fabric_received_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fabric_received_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.fabric_received_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inspector_private_notes">{{ trans('cruds.inspection.fields.inspector_private_notes') }}</label>
                            <textarea class="form-control" name="inspector_private_notes" id="inspector_private_notes">{{ old('inspector_private_notes', $inspection->inspector_private_notes) }}</textarea>
                            @if($errors->has('inspector_private_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inspector_private_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.inspector_private_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_notes">{{ trans('cruds.inspection.fields.public_notes') }}</label>
                            <textarea class="form-control" name="public_notes" id="public_notes">{{ old('public_notes', $inspection->public_notes) }}</textarea>
                            @if($errors->has('public_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.public_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qc_paid_date">{{ trans('cruds.inspection.fields.qc_paid_date') }}</label>
                            <input class="form-control date" type="text" name="qc_paid_date" id="qc_paid_date" value="{{ old('qc_paid_date', $inspection->qc_paid_date) }}">
                            @if($errors->has('qc_paid_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qc_paid_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspection.fields.qc_paid_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection