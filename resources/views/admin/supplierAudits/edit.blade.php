@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.supplierAudit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.supplier-audits.update", [$supplierAudit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="supplier_id">{{ trans('cruds.supplierAudit.fields.supplier') }}</label>
                <select class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                    @foreach($suppliers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('supplier_id') ? old('supplier_id') : $supplierAudit->supplier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('supplier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="inspector_id">{{ trans('cruds.supplierAudit.fields.inspector') }}</label>
                <select class="form-control select2 {{ $errors->has('inspector') ? 'is-invalid' : '' }}" name="inspector_id" id="inspector_id" required>
                    @foreach($inspectors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('inspector_id') ? old('inspector_id') : $supplierAudit->inspector->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('inspector'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inspector') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.inspector_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="audit_date">{{ trans('cruds.supplierAudit.fields.audit_date') }}</label>
                <input class="form-control date {{ $errors->has('audit_date') ? 'is-invalid' : '' }}" type="text" name="audit_date" id="audit_date" value="{{ old('audit_date', $supplierAudit->audit_date) }}">
                @if($errors->has('audit_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('audit_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.audit_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('passed_audit') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="passed_audit" value="0">
                    <input class="form-check-input" type="checkbox" name="passed_audit" id="passed_audit" value="1" {{ $supplierAudit->passed_audit || old('passed_audit', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="passed_audit">{{ trans('cruds.supplierAudit.fields.passed_audit') }}</label>
                </div>
                @if($errors->has('passed_audit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passed_audit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.passed_audit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_land_sqm">{{ trans('cruds.supplierAudit.fields.total_land_sqm') }}</label>
                <input class="form-control {{ $errors->has('total_land_sqm') ? 'is-invalid' : '' }}" type="number" name="total_land_sqm" id="total_land_sqm" value="{{ old('total_land_sqm', $supplierAudit->total_land_sqm) }}" step="1">
                @if($errors->has('total_land_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_land_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.total_land_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="factory_area_sqm">{{ trans('cruds.supplierAudit.fields.factory_area_sqm') }}</label>
                <input class="form-control {{ $errors->has('factory_area_sqm') ? 'is-invalid' : '' }}" type="number" name="factory_area_sqm" id="factory_area_sqm" value="{{ old('factory_area_sqm', $supplierAudit->factory_area_sqm) }}" step="1">
                @if($errors->has('factory_area_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('factory_area_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.factory_area_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="production_area_sqm">{{ trans('cruds.supplierAudit.fields.production_area_sqm') }}</label>
                <input class="form-control {{ $errors->has('production_area_sqm') ? 'is-invalid' : '' }}" type="number" name="production_area_sqm" id="production_area_sqm" value="{{ old('production_area_sqm', $supplierAudit->production_area_sqm) }}" step="1">
                @if($errors->has('production_area_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('production_area_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.production_area_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="inspection_area_sqm">{{ trans('cruds.supplierAudit.fields.inspection_area_sqm') }}</label>
                <input class="form-control {{ $errors->has('inspection_area_sqm') ? 'is-invalid' : '' }}" type="number" name="inspection_area_sqm" id="inspection_area_sqm" value="{{ old('inspection_area_sqm', $supplierAudit->inspection_area_sqm) }}" step="1">
                @if($errors->has('inspection_area_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inspection_area_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.inspection_area_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="packing_area_sqm">{{ trans('cruds.supplierAudit.fields.packing_area_sqm') }}</label>
                <input class="form-control {{ $errors->has('packing_area_sqm') ? 'is-invalid' : '' }}" type="number" name="packing_area_sqm" id="packing_area_sqm" value="{{ old('packing_area_sqm', $supplierAudit->packing_area_sqm) }}" step="1">
                @if($errors->has('packing_area_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('packing_area_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.packing_area_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="warehouse_area_sqm">{{ trans('cruds.supplierAudit.fields.warehouse_area_sqm') }}</label>
                <input class="form-control {{ $errors->has('warehouse_area_sqm') ? 'is-invalid' : '' }}" type="number" name="warehouse_area_sqm" id="warehouse_area_sqm" value="{{ old('warehouse_area_sqm', $supplierAudit->warehouse_area_sqm) }}" step="1">
                @if($errors->has('warehouse_area_sqm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('warehouse_area_sqm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.warehouse_area_sqm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_process_workers">{{ trans('cruds.supplierAudit.fields.qty_process_workers') }}</label>
                <input class="form-control {{ $errors->has('qty_process_workers') ? 'is-invalid' : '' }}" type="number" name="qty_process_workers" id="qty_process_workers" value="{{ old('qty_process_workers', $supplierAudit->qty_process_workers) }}" step="1">
                @if($errors->has('qty_process_workers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_process_workers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_process_workers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_admin_supervisors">{{ trans('cruds.supplierAudit.fields.qty_admin_supervisors') }}</label>
                <input class="form-control {{ $errors->has('qty_admin_supervisors') ? 'is-invalid' : '' }}" type="number" name="qty_admin_supervisors" id="qty_admin_supervisors" value="{{ old('qty_admin_supervisors', $supplierAudit->qty_admin_supervisors) }}" step="1">
                @if($errors->has('qty_admin_supervisors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_admin_supervisors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_admin_supervisors_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_r_and_d_staff">{{ trans('cruds.supplierAudit.fields.qty_r_and_d_staff') }}</label>
                <input class="form-control {{ $errors->has('qty_r_and_d_staff') ? 'is-invalid' : '' }}" type="number" name="qty_r_and_d_staff" id="qty_r_and_d_staff" value="{{ old('qty_r_and_d_staff', $supplierAudit->qty_r_and_d_staff) }}" step="1">
                @if($errors->has('qty_r_and_d_staff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_r_and_d_staff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_r_and_d_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_technicians">{{ trans('cruds.supplierAudit.fields.qty_technicians') }}</label>
                <input class="form-control {{ $errors->has('qty_technicians') ? 'is-invalid' : '' }}" type="number" name="qty_technicians" id="qty_technicians" value="{{ old('qty_technicians', $supplierAudit->qty_technicians) }}" step="1">
                @if($errors->has('qty_technicians'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_technicians') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_technicians_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_inline_qc">{{ trans('cruds.supplierAudit.fields.qty_inline_qc') }}</label>
                <input class="form-control {{ $errors->has('qty_inline_qc') ? 'is-invalid' : '' }}" type="number" name="qty_inline_qc" id="qty_inline_qc" value="{{ old('qty_inline_qc', $supplierAudit->qty_inline_qc) }}" step="1">
                @if($errors->has('qty_inline_qc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_inline_qc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_inline_qc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_final_qc">{{ trans('cruds.supplierAudit.fields.qty_final_qc') }}</label>
                <input class="form-control {{ $errors->has('qty_final_qc') ? 'is-invalid' : '' }}" type="number" name="qty_final_qc" id="qty_final_qc" value="{{ old('qty_final_qc', $supplierAudit->qty_final_qc) }}" step="1">
                @if($errors->has('qty_final_qc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_final_qc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_final_qc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_packing_staff">{{ trans('cruds.supplierAudit.fields.qty_packing_staff') }}</label>
                <input class="form-control {{ $errors->has('qty_packing_staff') ? 'is-invalid' : '' }}" type="number" name="qty_packing_staff" id="qty_packing_staff" value="{{ old('qty_packing_staff', $supplierAudit->qty_packing_staff) }}" step="1">
                @if($errors->has('qty_packing_staff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_packing_staff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_packing_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_total_staff">{{ trans('cruds.supplierAudit.fields.qty_total_staff') }}</label>
                <input class="form-control {{ $errors->has('qty_total_staff') ? 'is-invalid' : '' }}" type="number" name="qty_total_staff" id="qty_total_staff" value="{{ old('qty_total_staff', $supplierAudit->qty_total_staff) }}" step="1">
                @if($errors->has('qty_total_staff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_total_staff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_total_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_production_sites">{{ trans('cruds.supplierAudit.fields.qty_production_sites') }}</label>
                <input class="form-control {{ $errors->has('qty_production_sites') ? 'is-invalid' : '' }}" type="number" name="qty_production_sites" id="qty_production_sites" value="{{ old('qty_production_sites', $supplierAudit->qty_production_sites) }}" step="1">
                @if($errors->has('qty_production_sites'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_production_sites') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_production_sites_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_self_owned') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_self_owned" value="0">
                    <input class="form-check-input" type="checkbox" name="is_self_owned" id="is_self_owned" value="1" {{ $supplierAudit->is_self_owned || old('is_self_owned', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_self_owned">{{ trans('cruds.supplierAudit.fields.is_self_owned') }}</label>
                </div>
                @if($errors->has('is_self_owned'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_self_owned') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.is_self_owned_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_english_speaking_staff') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_english_speaking_staff" value="0">
                    <input class="form-check-input" type="checkbox" name="has_english_speaking_staff" id="has_english_speaking_staff" value="1" {{ $supplierAudit->has_english_speaking_staff || old('has_english_speaking_staff', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_english_speaking_staff">{{ trans('cruds.supplierAudit.fields.has_english_speaking_staff') }}</label>
                </div>
                @if($errors->has('has_english_speaking_staff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_english_speaking_staff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_english_speaking_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="annual_domestic_turnover_usd">{{ trans('cruds.supplierAudit.fields.annual_domestic_turnover_usd') }}</label>
                <input class="form-control {{ $errors->has('annual_domestic_turnover_usd') ? 'is-invalid' : '' }}" type="number" name="annual_domestic_turnover_usd" id="annual_domestic_turnover_usd" value="{{ old('annual_domestic_turnover_usd', $supplierAudit->annual_domestic_turnover_usd) }}" step="0.01">
                @if($errors->has('annual_domestic_turnover_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('annual_domestic_turnover_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.annual_domestic_turnover_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="annual_international_turnover_usd">{{ trans('cruds.supplierAudit.fields.annual_international_turnover_usd') }}</label>
                <input class="form-control {{ $errors->has('annual_international_turnover_usd') ? 'is-invalid' : '' }}" type="number" name="annual_international_turnover_usd" id="annual_international_turnover_usd" value="{{ old('annual_international_turnover_usd', $supplierAudit->annual_international_turnover_usd) }}" step="0.01">
                @if($errors->has('annual_international_turnover_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('annual_international_turnover_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.annual_international_turnover_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="export_countries">{{ trans('cruds.supplierAudit.fields.export_countries') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('export_countries') ? 'is-invalid' : '' }}" name="export_countries[]" id="export_countries" multiple>
                    @foreach($export_countries as $id => $export_countries)
                        <option value="{{ $id }}" {{ (in_array($id, old('export_countries', [])) || $supplierAudit->export_countries->contains($id)) ? 'selected' : '' }}>{{ $export_countries }}</option>
                    @endforeach
                </select>
                @if($errors->has('export_countries'))
                    <div class="invalid-feedback">
                        {{ $errors->first('export_countries') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.export_countries_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_social_iso_9001') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_social_iso_9001" value="0">
                    <input class="form-check-input" type="checkbox" name="has_social_iso_9001" id="has_social_iso_9001" value="1" {{ $supplierAudit->has_social_iso_9001 || old('has_social_iso_9001', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_social_iso_9001">{{ trans('cruds.supplierAudit.fields.has_social_iso_9001') }}</label>
                </div>
                @if($errors->has('has_social_iso_9001'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_social_iso_9001') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_social_iso_9001_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_production_iso_9001') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_production_iso_9001" value="0">
                    <input class="form-check-input" type="checkbox" name="has_production_iso_9001" id="has_production_iso_9001" value="1" {{ $supplierAudit->has_production_iso_9001 || old('has_production_iso_9001', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_production_iso_9001">{{ trans('cruds.supplierAudit.fields.has_production_iso_9001') }}</label>
                </div>
                @if($errors->has('has_production_iso_9001'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_production_iso_9001') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_production_iso_9001_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_hrs_per_day">{{ trans('cruds.supplierAudit.fields.qty_hrs_per_day') }}</label>
                <input class="form-control {{ $errors->has('qty_hrs_per_day') ? 'is-invalid' : '' }}" type="number" name="qty_hrs_per_day" id="qty_hrs_per_day" value="{{ old('qty_hrs_per_day', $supplierAudit->qty_hrs_per_day) }}" step="1">
                @if($errors->has('qty_hrs_per_day'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_hrs_per_day') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_hrs_per_day_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_hrs_per_week">{{ trans('cruds.supplierAudit.fields.qty_hrs_per_week') }}</label>
                <input class="form-control {{ $errors->has('qty_hrs_per_week') ? 'is-invalid' : '' }}" type="number" name="qty_hrs_per_week" id="qty_hrs_per_week" value="{{ old('qty_hrs_per_week', $supplierAudit->qty_hrs_per_week) }}" step="1">
                @if($errors->has('qty_hrs_per_week'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_hrs_per_week') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_hrs_per_week_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_work_days_per_month">{{ trans('cruds.supplierAudit.fields.qty_work_days_per_month') }}</label>
                <input class="form-control {{ $errors->has('qty_work_days_per_month') ? 'is-invalid' : '' }}" type="number" name="qty_work_days_per_month" id="qty_work_days_per_month" value="{{ old('qty_work_days_per_month', $supplierAudit->qty_work_days_per_month) }}" step="1">
                @if($errors->has('qty_work_days_per_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_work_days_per_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_work_days_per_month_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('ppe_provided') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="ppe_provided" value="0">
                    <input class="form-check-input" type="checkbox" name="ppe_provided" id="ppe_provided" value="1" {{ $supplierAudit->ppe_provided || old('ppe_provided', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ppe_provided">{{ trans('cruds.supplierAudit.fields.ppe_provided') }}</label>
                </div>
                @if($errors->has('ppe_provided'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ppe_provided') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.ppe_provided_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('ppe_used') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="ppe_used" value="0">
                    <input class="form-check-input" type="checkbox" name="ppe_used" id="ppe_used" value="1" {{ $supplierAudit->ppe_used || old('ppe_used', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ppe_used">{{ trans('cruds.supplierAudit.fields.ppe_used') }}</label>
                </div>
                @if($errors->has('ppe_used'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ppe_used') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.ppe_used_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('safe_chemical_storage') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="safe_chemical_storage" value="0">
                    <input class="form-check-input" type="checkbox" name="safe_chemical_storage" id="safe_chemical_storage" value="1" {{ $supplierAudit->safe_chemical_storage || old('safe_chemical_storage', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="safe_chemical_storage">{{ trans('cruds.supplierAudit.fields.safe_chemical_storage') }}</label>
                </div>
                @if($errors->has('safe_chemical_storage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('safe_chemical_storage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.safe_chemical_storage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wood_moisture">{{ trans('cruds.supplierAudit.fields.wood_moisture') }}</label>
                <input class="form-control {{ $errors->has('wood_moisture') ? 'is-invalid' : '' }}" type="text" name="wood_moisture" id="wood_moisture" value="{{ old('wood_moisture', $supplierAudit->wood_moisture) }}">
                @if($errors->has('wood_moisture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wood_moisture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.wood_moisture_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wood_drying">{{ trans('cruds.supplierAudit.fields.wood_drying') }}</label>
                <input class="form-control {{ $errors->has('wood_drying') ? 'is-invalid' : '' }}" type="text" name="wood_drying" id="wood_drying" value="{{ old('wood_drying', $supplierAudit->wood_drying) }}">
                @if($errors->has('wood_drying'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wood_drying') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.wood_drying_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wood_quality">{{ trans('cruds.supplierAudit.fields.wood_quality') }}</label>
                <input class="form-control {{ $errors->has('wood_quality') ? 'is-invalid' : '' }}" type="text" name="wood_quality" id="wood_quality" value="{{ old('wood_quality', $supplierAudit->wood_quality) }}">
                @if($errors->has('wood_quality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wood_quality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.wood_quality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wood_storage">{{ trans('cruds.supplierAudit.fields.wood_storage') }}</label>
                <input class="form-control {{ $errors->has('wood_storage') ? 'is-invalid' : '' }}" type="text" name="wood_storage" id="wood_storage" value="{{ old('wood_storage', $supplierAudit->wood_storage) }}">
                @if($errors->has('wood_storage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wood_storage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.wood_storage_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('ukfr_cali_foam_ok') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="ukfr_cali_foam_ok" value="0">
                    <input class="form-check-input" type="checkbox" name="ukfr_cali_foam_ok" id="ukfr_cali_foam_ok" value="1" {{ $supplierAudit->ukfr_cali_foam_ok || old('ukfr_cali_foam_ok', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ukfr_cali_foam_ok">{{ trans('cruds.supplierAudit.fields.ukfr_cali_foam_ok') }}</label>
                </div>
                @if($errors->has('ukfr_cali_foam_ok'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ukfr_cali_foam_ok') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.ukfr_cali_foam_ok_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foam_density">{{ trans('cruds.supplierAudit.fields.foam_density') }}</label>
                <input class="form-control {{ $errors->has('foam_density') ? 'is-invalid' : '' }}" type="text" name="foam_density" id="foam_density" value="{{ old('foam_density', $supplierAudit->foam_density) }}">
                @if($errors->has('foam_density'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foam_density') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.foam_density_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foam_identification">{{ trans('cruds.supplierAudit.fields.foam_identification') }}</label>
                <input class="form-control {{ $errors->has('foam_identification') ? 'is-invalid' : '' }}" type="text" name="foam_identification" id="foam_identification" value="{{ old('foam_identification', $supplierAudit->foam_identification) }}">
                @if($errors->has('foam_identification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foam_identification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.foam_identification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="composite_wood_identification">{{ trans('cruds.supplierAudit.fields.composite_wood_identification') }}</label>
                <input class="form-control {{ $errors->has('composite_wood_identification') ? 'is-invalid' : '' }}" type="text" name="composite_wood_identification" id="composite_wood_identification" value="{{ old('composite_wood_identification', $supplierAudit->composite_wood_identification) }}">
                @if($errors->has('composite_wood_identification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('composite_wood_identification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.composite_wood_identification_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('passed_pu_pvc_reach_phthalat') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="passed_pu_pvc_reach_phthalat" value="0">
                    <input class="form-check-input" type="checkbox" name="passed_pu_pvc_reach_phthalat" id="passed_pu_pvc_reach_phthalat" value="1" {{ $supplierAudit->passed_pu_pvc_reach_phthalat || old('passed_pu_pvc_reach_phthalat', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="passed_pu_pvc_reach_phthalat">{{ trans('cruds.supplierAudit.fields.passed_pu_pvc_reach_phthalat') }}</label>
                </div>
                @if($errors->has('passed_pu_pvc_reach_phthalat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passed_pu_pvc_reach_phthalat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.passed_pu_pvc_reach_phthalat_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('passed_silica_gel_bag_dmf') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="passed_silica_gel_bag_dmf" value="0">
                    <input class="form-check-input" type="checkbox" name="passed_silica_gel_bag_dmf" id="passed_silica_gel_bag_dmf" value="1" {{ $supplierAudit->passed_silica_gel_bag_dmf || old('passed_silica_gel_bag_dmf', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="passed_silica_gel_bag_dmf">{{ trans('cruds.supplierAudit.fields.passed_silica_gel_bag_dmf') }}</label>
                </div>
                @if($errors->has('passed_silica_gel_bag_dmf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passed_silica_gel_bag_dmf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.passed_silica_gel_bag_dmf_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('passed_mdf_pw_pb') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="passed_mdf_pw_pb" value="0">
                    <input class="form-check-input" type="checkbox" name="passed_mdf_pw_pb" id="passed_mdf_pw_pb" value="1" {{ $supplierAudit->passed_mdf_pw_pb || old('passed_mdf_pw_pb', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="passed_mdf_pw_pb">{{ trans('cruds.supplierAudit.fields.passed_mdf_pw_pb') }}</label>
                </div>
                @if($errors->has('passed_mdf_pw_pb'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passed_mdf_pw_pb') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.passed_mdf_pw_pb_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subcontracted_items">{{ trans('cruds.supplierAudit.fields.subcontracted_items') }}</label>
                <textarea class="form-control {{ $errors->has('subcontracted_items') ? 'is-invalid' : '' }}" name="subcontracted_items" id="subcontracted_items">{{ old('subcontracted_items', $supplierAudit->subcontracted_items) }}</textarea>
                @if($errors->has('subcontracted_items'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subcontracted_items') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.subcontracted_items_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_major_subcontractors">{{ trans('cruds.supplierAudit.fields.qty_major_subcontractors') }}</label>
                <input class="form-control {{ $errors->has('qty_major_subcontractors') ? 'is-invalid' : '' }}" type="number" name="qty_major_subcontractors" id="qty_major_subcontractors" value="{{ old('qty_major_subcontractors', $supplierAudit->qty_major_subcontractors) }}" step="1">
                @if($errors->has('qty_major_subcontractors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_major_subcontractors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_major_subcontractors_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty_subcontractors_per_component">{{ trans('cruds.supplierAudit.fields.qty_subcontractors_per_component') }}</label>
                <input class="form-control {{ $errors->has('qty_subcontractors_per_component') ? 'is-invalid' : '' }}" type="number" name="qty_subcontractors_per_component" id="qty_subcontractors_per_component" value="{{ old('qty_subcontractors_per_component', $supplierAudit->qty_subcontractors_per_component) }}" step="1">
                @if($errors->has('qty_subcontractors_per_component'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty_subcontractors_per_component') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.qty_subcontractors_per_component_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avg_num_yrs_with_subcontractors">{{ trans('cruds.supplierAudit.fields.avg_num_yrs_with_subcontractors') }}</label>
                <input class="form-control {{ $errors->has('avg_num_yrs_with_subcontractors') ? 'is-invalid' : '' }}" type="number" name="avg_num_yrs_with_subcontractors" id="avg_num_yrs_with_subcontractors" value="{{ old('avg_num_yrs_with_subcontractors', $supplierAudit->avg_num_yrs_with_subcontractors) }}" step="1">
                @if($errors->has('avg_num_yrs_with_subcontractors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('avg_num_yrs_with_subcontractors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.avg_num_yrs_with_subcontractors_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('regular_subcontractors') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="regular_subcontractors" value="0">
                    <input class="form-check-input" type="checkbox" name="regular_subcontractors" id="regular_subcontractors" value="1" {{ $supplierAudit->regular_subcontractors || old('regular_subcontractors', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="regular_subcontractors">{{ trans('cruds.supplierAudit.fields.regular_subcontractors') }}</label>
                </div>
                @if($errors->has('regular_subcontractors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regular_subcontractors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.regular_subcontractors_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="month_cap_40_hq">{{ trans('cruds.supplierAudit.fields.month_cap_40_hq') }}</label>
                <input class="form-control {{ $errors->has('month_cap_40_hq') ? 'is-invalid' : '' }}" type="number" name="month_cap_40_hq" id="month_cap_40_hq" value="{{ old('month_cap_40_hq', $supplierAudit->month_cap_40_hq) }}" step="1">
                @if($errors->has('month_cap_40_hq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month_cap_40_hq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.month_cap_40_hq_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="annual_cap_40_hq">{{ trans('cruds.supplierAudit.fields.annual_cap_40_hq') }}</label>
                <input class="form-control {{ $errors->has('annual_cap_40_hq') ? 'is-invalid' : '' }}" type="number" name="annual_cap_40_hq" id="annual_cap_40_hq" value="{{ old('annual_cap_40_hq', $supplierAudit->annual_cap_40_hq) }}" step="1">
                @if($errors->has('annual_cap_40_hq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('annual_cap_40_hq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.annual_cap_40_hq_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="month_cap_40_hq_free">{{ trans('cruds.supplierAudit.fields.month_cap_40_hq_free') }}</label>
                <input class="form-control {{ $errors->has('month_cap_40_hq_free') ? 'is-invalid' : '' }}" type="number" name="month_cap_40_hq_free" id="month_cap_40_hq_free" value="{{ old('month_cap_40_hq_free', $supplierAudit->month_cap_40_hq_free) }}" step="1">
                @if($errors->has('month_cap_40_hq_free'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month_cap_40_hq_free') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.month_cap_40_hq_free_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="moq_40_hq">{{ trans('cruds.supplierAudit.fields.moq_40_hq') }}</label>
                <input class="form-control {{ $errors->has('moq_40_hq') ? 'is-invalid' : '' }}" type="number" name="moq_40_hq" id="moq_40_hq" value="{{ old('moq_40_hq', $supplierAudit->moq_40_hq) }}" step="1">
                @if($errors->has('moq_40_hq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('moq_40_hq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.moq_40_hq_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="std_lead_time_days">{{ trans('cruds.supplierAudit.fields.std_lead_time_days') }}</label>
                <input class="form-control {{ $errors->has('std_lead_time_days') ? 'is-invalid' : '' }}" type="number" name="std_lead_time_days" id="std_lead_time_days" value="{{ old('std_lead_time_days', $supplierAudit->std_lead_time_days) }}" step="1">
                @if($errors->has('std_lead_time_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('std_lead_time_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.std_lead_time_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sample_lead_time_days">{{ trans('cruds.supplierAudit.fields.sample_lead_time_days') }}</label>
                <input class="form-control {{ $errors->has('sample_lead_time_days') ? 'is-invalid' : '' }}" type="number" name="sample_lead_time_days" id="sample_lead_time_days" value="{{ old('sample_lead_time_days', $supplierAudit->sample_lead_time_days) }}" step="1">
                @if($errors->has('sample_lead_time_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sample_lead_time_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.sample_lead_time_days_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pass_qc_doc_audit') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pass_qc_doc_audit" value="0">
                    <input class="form-check-input" type="checkbox" name="pass_qc_doc_audit" id="pass_qc_doc_audit" value="1" {{ $supplierAudit->pass_qc_doc_audit || old('pass_qc_doc_audit', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pass_qc_doc_audit">{{ trans('cruds.supplierAudit.fields.pass_qc_doc_audit') }}</label>
                </div>
                @if($errors->has('pass_qc_doc_audit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pass_qc_doc_audit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.pass_qc_doc_audit_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_full_iqc') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_full_iqc" value="0">
                    <input class="form-check-input" type="checkbox" name="has_full_iqc" id="has_full_iqc" value="1" {{ $supplierAudit->has_full_iqc || old('has_full_iqc', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_full_iqc">{{ trans('cruds.supplierAudit.fields.has_full_iqc') }}</label>
                </div>
                @if($errors->has('has_full_iqc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_full_iqc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_full_iqc_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_full_oqc') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_full_oqc" value="0">
                    <input class="form-check-input" type="checkbox" name="has_full_oqc" id="has_full_oqc" value="1" {{ $supplierAudit->has_full_oqc || old('has_full_oqc', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_full_oqc">{{ trans('cruds.supplierAudit.fields.has_full_oqc') }}</label>
                </div>
                @if($errors->has('has_full_oqc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_full_oqc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_full_oqc_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_reg_qc_training') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_reg_qc_training" value="0">
                    <input class="form-check-input" type="checkbox" name="has_reg_qc_training" id="has_reg_qc_training" value="1" {{ $supplierAudit->has_reg_qc_training || old('has_reg_qc_training', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_reg_qc_training">{{ trans('cruds.supplierAudit.fields.has_reg_qc_training') }}</label>
                </div>
                @if($errors->has('has_reg_qc_training'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_reg_qc_training') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.has_reg_qc_training_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_1_name">{{ trans('cruds.supplierAudit.fields.client_1_name') }}</label>
                <input class="form-control {{ $errors->has('client_1_name') ? 'is-invalid' : '' }}" type="text" name="client_1_name" id="client_1_name" value="{{ old('client_1_name', $supplierAudit->client_1_name) }}">
                @if($errors->has('client_1_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_1_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_1_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_1_country_id">{{ trans('cruds.supplierAudit.fields.client_1_country') }}</label>
                <select class="form-control select2 {{ $errors->has('client_1_country') ? 'is-invalid' : '' }}" name="client_1_country_id" id="client_1_country_id">
                    @foreach($client_1_countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_1_country_id') ? old('client_1_country_id') : $supplierAudit->client_1_country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_1_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_1_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_1_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_1_company_id">{{ trans('cruds.supplierAudit.fields.client_1_company') }}</label>
                <select class="form-control select2 {{ $errors->has('client_1_company') ? 'is-invalid' : '' }}" name="client_1_company_id" id="client_1_company_id">
                    @foreach($client_1_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_1_company_id') ? old('client_1_company_id') : $supplierAudit->client_1_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_1_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_1_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_1_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_1_product_types">{{ trans('cruds.supplierAudit.fields.client_1_product_type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('client_1_product_types') ? 'is-invalid' : '' }}" name="client_1_product_types[]" id="client_1_product_types" multiple>
                    @foreach($client_1_product_types as $id => $client_1_product_type)
                        <option value="{{ $id }}" {{ (in_array($id, old('client_1_product_types', [])) || $supplierAudit->client_1_product_types->contains($id)) ? 'selected' : '' }}>{{ $client_1_product_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_1_product_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_1_product_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_1_product_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_1_containers_month">{{ trans('cruds.supplierAudit.fields.client_1_containers_month') }}</label>
                <input class="form-control {{ $errors->has('client_1_containers_month') ? 'is-invalid' : '' }}" type="number" name="client_1_containers_month" id="client_1_containers_month" value="{{ old('client_1_containers_month', $supplierAudit->client_1_containers_month) }}" step="1">
                @if($errors->has('client_1_containers_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_1_containers_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_1_containers_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_2_name">{{ trans('cruds.supplierAudit.fields.client_2_name') }}</label>
                <input class="form-control {{ $errors->has('client_2_name') ? 'is-invalid' : '' }}" type="text" name="client_2_name" id="client_2_name" value="{{ old('client_2_name', $supplierAudit->client_2_name) }}">
                @if($errors->has('client_2_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_2_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_2_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_2_country_id">{{ trans('cruds.supplierAudit.fields.client_2_country') }}</label>
                <select class="form-control select2 {{ $errors->has('client_2_country') ? 'is-invalid' : '' }}" name="client_2_country_id" id="client_2_country_id">
                    @foreach($client_2_countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_2_country_id') ? old('client_2_country_id') : $supplierAudit->client_2_country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_2_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_2_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_2_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_2_company_id">{{ trans('cruds.supplierAudit.fields.client_2_company') }}</label>
                <select class="form-control select2 {{ $errors->has('client_2_company') ? 'is-invalid' : '' }}" name="client_2_company_id" id="client_2_company_id">
                    @foreach($client_2_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_2_company_id') ? old('client_2_company_id') : $supplierAudit->client_2_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_2_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_2_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_2_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_2_product_type">{{ trans('cruds.supplierAudit.fields.client_2_product_type') }}</label>
                <input class="form-control {{ $errors->has('client_2_product_type') ? 'is-invalid' : '' }}" type="text" name="client_2_product_type" id="client_2_product_type" value="{{ old('client_2_product_type', $supplierAudit->client_2_product_type) }}">
                @if($errors->has('client_2_product_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_2_product_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_2_product_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_2_containers_month">{{ trans('cruds.supplierAudit.fields.client_2_containers_month') }}</label>
                <input class="form-control {{ $errors->has('client_2_containers_month') ? 'is-invalid' : '' }}" type="number" name="client_2_containers_month" id="client_2_containers_month" value="{{ old('client_2_containers_month', $supplierAudit->client_2_containers_month) }}" step="1">
                @if($errors->has('client_2_containers_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_2_containers_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_2_containers_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_3_name">{{ trans('cruds.supplierAudit.fields.client_3_name') }}</label>
                <input class="form-control {{ $errors->has('client_3_name') ? 'is-invalid' : '' }}" type="text" name="client_3_name" id="client_3_name" value="{{ old('client_3_name', $supplierAudit->client_3_name) }}">
                @if($errors->has('client_3_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_3_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_3_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_3_country_id">{{ trans('cruds.supplierAudit.fields.client_3_country') }}</label>
                <select class="form-control select2 {{ $errors->has('client_3_country') ? 'is-invalid' : '' }}" name="client_3_country_id" id="client_3_country_id">
                    @foreach($client_3_countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_3_country_id') ? old('client_3_country_id') : $supplierAudit->client_3_country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_3_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_3_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_3_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_3_company_id">{{ trans('cruds.supplierAudit.fields.client_3_company') }}</label>
                <select class="form-control select2 {{ $errors->has('client_3_company') ? 'is-invalid' : '' }}" name="client_3_company_id" id="client_3_company_id">
                    @foreach($client_3_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_3_company_id') ? old('client_3_company_id') : $supplierAudit->client_3_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_3_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_3_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_3_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_3_product_type">{{ trans('cruds.supplierAudit.fields.client_3_product_type') }}</label>
                <input class="form-control {{ $errors->has('client_3_product_type') ? 'is-invalid' : '' }}" type="text" name="client_3_product_type" id="client_3_product_type" value="{{ old('client_3_product_type', $supplierAudit->client_3_product_type) }}">
                @if($errors->has('client_3_product_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_3_product_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_3_product_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_3_containers_month">{{ trans('cruds.supplierAudit.fields.client_3_containers_month') }}</label>
                <input class="form-control {{ $errors->has('client_3_containers_month') ? 'is-invalid' : '' }}" type="number" name="client_3_containers_month" id="client_3_containers_month" value="{{ old('client_3_containers_month', $supplierAudit->client_3_containers_month) }}" step="1">
                @if($errors->has('client_3_containers_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_3_containers_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.client_3_containers_month_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('address_confirmed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="address_confirmed" value="0">
                    <input class="form-check-input" type="checkbox" name="address_confirmed" id="address_confirmed" value="1" {{ $supplierAudit->address_confirmed || old('address_confirmed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="address_confirmed">{{ trans('cruds.supplierAudit.fields.address_confirmed') }}</label>
                </div>
                @if($errors->has('address_confirmed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_confirmed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.address_confirmed_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pay_minimum_wage') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pay_minimum_wage" value="0">
                    <input class="form-check-input" type="checkbox" name="pay_minimum_wage" id="pay_minimum_wage" value="1" {{ $supplierAudit->pay_minimum_wage || old('pay_minimum_wage', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pay_minimum_wage">{{ trans('cruds.supplierAudit.fields.pay_minimum_wage') }}</label>
                </div>
                @if($errors->has('pay_minimum_wage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pay_minimum_wage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.pay_minimum_wage_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('withhold_salary') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="withhold_salary" value="0">
                    <input class="form-check-input" type="checkbox" name="withhold_salary" id="withhold_salary" value="1" {{ $supplierAudit->withhold_salary || old('withhold_salary', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="withhold_salary">{{ trans('cruds.supplierAudit.fields.withhold_salary') }}</label>
                </div>
                @if($errors->has('withhold_salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('withhold_salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.withhold_salary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overtime_rate_usd">{{ trans('cruds.supplierAudit.fields.overtime_rate_usd') }}</label>
                <input class="form-control {{ $errors->has('overtime_rate_usd') ? 'is-invalid' : '' }}" type="number" name="overtime_rate_usd" id="overtime_rate_usd" value="{{ old('overtime_rate_usd', $supplierAudit->overtime_rate_usd) }}" step="0.01">
                @if($errors->has('overtime_rate_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overtime_rate_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.overtime_rate_usd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_materials_id">{{ trans('cruds.supplierAudit.fields.primary_materials') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_materials') ? 'is-invalid' : '' }}" name="primary_materials_id" id="primary_materials_id">
                    @foreach($primary_materials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('primary_materials_id') ? old('primary_materials_id') : $supplierAudit->primary_materials->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_materials'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_materials') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplierAudit.fields.primary_materials_helper') }}</span>
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