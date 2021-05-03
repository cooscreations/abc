@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.address.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <td>
                            {{ $address->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.name') }}
                        </th>
                        <td>
                            {{ $address->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.company') }}
                        </th>
                        <td>
                            {{ $address->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.add_line_1') }}
                        </th>
                        <td>
                            {{ $address->add_line_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.add_line_2') }}
                        </th>
                        <td>
                            {{ $address->add_line_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.add_line_3') }}
                        </th>
                        <td>
                            {{ $address->add_line_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <td>
                            {{ $address->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.province') }}
                        </th>
                        <td>
                            {{ $address->province->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.country') }}
                        </th>
                        <td>
                            {{ $address->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.is_billing_address') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $address->is_billing_address ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.is_shipping_address') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $address->is_shipping_address ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.nearest_shipping_port') }}
                        </th>
                        <td>
                            {{ $address->nearest_shipping_port->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
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
            <a class="nav-link" href="#bill_to_address_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ship_to_address_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#location_equipment_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.equipmentAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#address_bank_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.bankAccount.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_address_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#nearest_shipping_port_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ship_from_port_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ship_to_port_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#addresses_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_to_address_orders">
            @includeIf('admin.addresses.relationships.billToAddressOrders', ['orders' => $address->billToAddressOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="ship_to_address_orders">
            @includeIf('admin.addresses.relationships.shipToAddressOrders', ['orders' => $address->shipToAddressOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="location_equipment_audits">
            @includeIf('admin.addresses.relationships.locationEquipmentAudits', ['equipmentAudits' => $address->locationEquipmentAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="address_bank_accounts">
            @includeIf('admin.addresses.relationships.addressBankAccounts', ['bankAccounts' => $address->addressBankAccounts])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_address_contact_contacts">
            @includeIf('admin.addresses.relationships.primaryAddressContactContacts', ['contactContacts' => $address->primaryAddressContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="nearest_shipping_port_addresses">
            @includeIf('admin.addresses.relationships.nearestShippingPortAddresses', ['addresses' => $address->nearestShippingPortAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="ship_from_port_orders">
            @includeIf('admin.addresses.relationships.shipFromPortOrders', ['orders' => $address->shipFromPortOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="ship_to_port_orders">
            @includeIf('admin.addresses.relationships.shipToPortOrders', ['orders' => $address->shipToPortOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="addresses_contact_companies">
            @includeIf('admin.addresses.relationships.addressesContactCompanies', ['contactCompanies' => $address->addressesContactCompanies])
        </div>
    </div>
</div>

@endsection