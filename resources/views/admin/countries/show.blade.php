@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.country.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.id') }}
                        </th>
                        <td>
                            {{ $country->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.name') }}
                        </th>
                        <td>
                            {{ $country->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.short_code') }}
                        </th>
                        <td>
                            {{ $country->short_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.alpha_2') }}
                        </th>
                        <td>
                            {{ $country->alpha_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.alpha_3') }}
                        </th>
                        <td>
                            {{ $country->alpha_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.world_region') }}
                        </th>
                        <td>
                            {{ $country->world_region->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.notes') }}
                        </th>
                        <td>
                            {!! $country->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.wiki_url') }}
                        </th>
                        <td>
                            {{ $country->wiki_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.default_currency') }}
                        </th>
                        <td>
                            {{ $country->default_currency->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.iso_number') }}
                        </th>
                        <td>
                            {{ $country->iso_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
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
            <a class="nav-link" href="#reg_country_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#country_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#country_provinces" role="tab" data-toggle="tab">
                {{ trans('cruds.province.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#country_of_birth_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#current_country_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client1_country_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client2_country_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client3_country_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#countries_currencies" role="tab" data-toggle="tab">
                {{ trans('cruds.currency.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#export_countries_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="reg_country_contact_companies">
            @includeIf('admin.countries.relationships.regCountryContactCompanies', ['contactCompanies' => $country->regCountryContactCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="country_addresses">
            @includeIf('admin.countries.relationships.countryAddresses', ['addresses' => $country->countryAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="country_provinces">
            @includeIf('admin.countries.relationships.countryProvinces', ['provinces' => $country->countryProvinces])
        </div>
        <div class="tab-pane" role="tabpanel" id="country_of_birth_contact_contacts">
            @includeIf('admin.countries.relationships.countryOfBirthContactContacts', ['contactContacts' => $country->countryOfBirthContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="current_country_contact_contacts">
            @includeIf('admin.countries.relationships.currentCountryContactContacts', ['contactContacts' => $country->currentCountryContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="client1_country_supplier_audits">
            @includeIf('admin.countries.relationships.client1CountrySupplierAudits', ['supplierAudits' => $country->client1CountrySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="client2_country_supplier_audits">
            @includeIf('admin.countries.relationships.client2CountrySupplierAudits', ['supplierAudits' => $country->client2CountrySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="client3_country_supplier_audits">
            @includeIf('admin.countries.relationships.client3CountrySupplierAudits', ['supplierAudits' => $country->client3CountrySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="countries_currencies">
            @includeIf('admin.countries.relationships.countriesCurrencies', ['currencies' => $country->countriesCurrencies])
        </div>
        <div class="tab-pane" role="tabpanel" id="export_countries_supplier_audits">
            @includeIf('admin.countries.relationships.exportCountriesSupplierAudits', ['supplierAudits' => $country->exportCountriesSupplierAudits])
        </div>
    </div>
</div>

@endsection