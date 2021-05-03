@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supplierAudit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-audits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.id') }}
                        </th>
                        <td>
                            {{ $supplierAudit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.supplier') }}
                        </th>
                        <td>
                            {{ $supplierAudit->supplier->company_short_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.inspector') }}
                        </th>
                        <td>
                            {{ $supplierAudit->inspector->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.audit_date') }}
                        </th>
                        <td>
                            {{ $supplierAudit->audit_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.passed_audit') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->passed_audit ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.total_land_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->total_land_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.factory_area_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->factory_area_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.production_area_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->production_area_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.inspection_area_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->inspection_area_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.packing_area_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->packing_area_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.warehouse_area_sqm') }}
                        </th>
                        <td>
                            {{ $supplierAudit->warehouse_area_sqm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_process_workers') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_process_workers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_admin_supervisors') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_admin_supervisors }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_r_and_d_staff') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_r_and_d_staff }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_technicians') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_technicians }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_inline_qc') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_inline_qc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_final_qc') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_final_qc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_packing_staff') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_packing_staff }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_total_staff') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_total_staff }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_production_sites') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_production_sites }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.is_self_owned') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->is_self_owned ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_english_speaking_staff') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_english_speaking_staff ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.annual_domestic_turnover_usd') }}
                        </th>
                        <td>
                            {{ $supplierAudit->annual_domestic_turnover_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.annual_international_turnover_usd') }}
                        </th>
                        <td>
                            {{ $supplierAudit->annual_international_turnover_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.export_countries') }}
                        </th>
                        <td>
                            @foreach($supplierAudit->export_countries as $key => $export_countries)
                                <span class="label label-info">{{ $export_countries->alpha_2 }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_social_iso_9001') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_social_iso_9001 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_production_iso_9001') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_production_iso_9001 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_hrs_per_day') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_hrs_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_hrs_per_week') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_hrs_per_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_work_days_per_month') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_work_days_per_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.ppe_provided') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->ppe_provided ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.ppe_used') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->ppe_used ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.safe_chemical_storage') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->safe_chemical_storage ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.wood_moisture') }}
                        </th>
                        <td>
                            {{ $supplierAudit->wood_moisture }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.wood_drying') }}
                        </th>
                        <td>
                            {{ $supplierAudit->wood_drying }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.wood_quality') }}
                        </th>
                        <td>
                            {{ $supplierAudit->wood_quality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.wood_storage') }}
                        </th>
                        <td>
                            {{ $supplierAudit->wood_storage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.ukfr_cali_foam_ok') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->ukfr_cali_foam_ok ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.foam_density') }}
                        </th>
                        <td>
                            {{ $supplierAudit->foam_density }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.foam_identification') }}
                        </th>
                        <td>
                            {{ $supplierAudit->foam_identification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.composite_wood_identification') }}
                        </th>
                        <td>
                            {{ $supplierAudit->composite_wood_identification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.passed_pu_pvc_reach_phthalat') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->passed_pu_pvc_reach_phthalat ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.passed_silica_gel_bag_dmf') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->passed_silica_gel_bag_dmf ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.passed_mdf_pw_pb') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->passed_mdf_pw_pb ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.subcontracted_items') }}
                        </th>
                        <td>
                            {{ $supplierAudit->subcontracted_items }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_major_subcontractors') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_major_subcontractors }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.qty_subcontractors_per_component') }}
                        </th>
                        <td>
                            {{ $supplierAudit->qty_subcontractors_per_component }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.avg_num_yrs_with_subcontractors') }}
                        </th>
                        <td>
                            {{ $supplierAudit->avg_num_yrs_with_subcontractors }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.regular_subcontractors') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->regular_subcontractors ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.month_cap_40_hq') }}
                        </th>
                        <td>
                            {{ $supplierAudit->month_cap_40_hq }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.annual_cap_40_hq') }}
                        </th>
                        <td>
                            {{ $supplierAudit->annual_cap_40_hq }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.month_cap_40_hq_free') }}
                        </th>
                        <td>
                            {{ $supplierAudit->month_cap_40_hq_free }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.moq_40_hq') }}
                        </th>
                        <td>
                            {{ $supplierAudit->moq_40_hq }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.std_lead_time_days') }}
                        </th>
                        <td>
                            {{ $supplierAudit->std_lead_time_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.sample_lead_time_days') }}
                        </th>
                        <td>
                            {{ $supplierAudit->sample_lead_time_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.pass_qc_doc_audit') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->pass_qc_doc_audit ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_full_iqc') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_full_iqc ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_full_oqc') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_full_oqc ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.has_reg_qc_training') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->has_reg_qc_training ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_1_name') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_1_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_1_country') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_1_country->alpha_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_1_company') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_1_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_1_product_type') }}
                        </th>
                        <td>
                            @foreach($supplierAudit->client_1_product_types as $key => $client_1_product_type)
                                <span class="label label-info">{{ $client_1_product_type->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_1_containers_month') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_1_containers_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_2_name') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_2_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_2_country') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_2_country->alpha_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_2_company') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_2_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_2_product_type') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_2_product_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_2_containers_month') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_2_containers_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_3_name') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_3_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_3_country') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_3_country->short_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_3_company') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_3_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_3_product_type') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_3_product_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.client_3_containers_month') }}
                        </th>
                        <td>
                            {{ $supplierAudit->client_3_containers_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.address_confirmed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->address_confirmed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.pay_minimum_wage') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->pay_minimum_wage ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.withhold_salary') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->withhold_salary ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.overtime_rate_usd') }}
                        </th>
                        <td>
                            {{ $supplierAudit->overtime_rate_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierAudit.fields.primary_materials') }}
                        </th>
                        <td>
                            {{ $supplierAudit->primary_materials->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-audits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection