@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.contactCompany.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.contact-companies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_short_code') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_short_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_name') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.parent_company') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->parent_company->company_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_website') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_website }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_email') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.primary_company_type') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->primary_company_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.reg_country') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->reg_country->alpha_2 ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.formal_reg_name') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->formal_reg_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.local_name') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->local_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_reg_date') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_reg_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.has_english_speaking_staff') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contactCompany->has_english_speaking_staff ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.owner_contact') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->owner_contact->contact_first_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.ownership_type') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->ownership_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_reg_num') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_reg_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_reg_expiry') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->company_reg_expiry }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.export_license_num') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->export_license_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.import_license_num') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->import_license_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.social_9001') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contactCompany->social_9001 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.production_9001') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contactCompany->production_9001 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.anti_slavery_policy') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contactCompany->anti_slavery_policy ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.bsci_certified') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contactCompany->bsci_certified ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.primary_language') }}
                                    </th>
                                    <td>
                                        {{ $contactCompany->primary_language->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.addresses') }}
                                    </th>
                                    <td>
                                        @foreach($contactCompany->addresses as $key => $addresses)
                                            <span class="label label-info">{{ $addresses->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.contact-companies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection