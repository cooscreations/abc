@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-companies.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.contact-companies.index') }}">
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
            <a class="nav-link" href="#company_product_nicknames" role="tab" data-toggle="tab">
                {{ trans('cruds.productNickname.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#customer_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#company_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#shipping_company_shipping_containers" role="tab" data-toggle="tab">
                {{ trans('cruds.shippingContainer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#company_company_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.companyRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#manufacturer_equipment" role="tab" data-toggle="tab">
                {{ trans('cruds.equipment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#company_equipment_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.equipmentAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_supplier_fabric_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.fabricGroup.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#company_bank_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.bankAccount.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#customer_fabric_nicknames" role="tab" data-toggle="tab">
                {{ trans('cruds.fabricNickname.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#customer_inspections" role="tab" data-toggle="tab">
                {{ trans('cruds.inspection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#shipping_agent_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client1_company_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client2_company_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client3_company_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#parent_company_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_companies_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_suppliers_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_supplier_component_parts" role="tab" data-toggle="tab">
                {{ trans('cruds.componentPart.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="company_product_nicknames">
            @includeIf('admin.contactCompanies.relationships.companyProductNicknames', ['productNicknames' => $contactCompany->companyProductNicknames])
        </div>
        <div class="tab-pane" role="tabpanel" id="customer_orders">
            @includeIf('admin.contactCompanies.relationships.customerOrders', ['orders' => $contactCompany->customerOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_orders">
            @includeIf('admin.contactCompanies.relationships.supplierOrders', ['orders' => $contactCompany->supplierOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="company_addresses">
            @includeIf('admin.contactCompanies.relationships.companyAddresses', ['addresses' => $contactCompany->companyAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="shipping_company_shipping_containers">
            @includeIf('admin.contactCompanies.relationships.shippingCompanyShippingContainers', ['shippingContainers' => $contactCompany->shippingCompanyShippingContainers])
        </div>
        <div class="tab-pane" role="tabpanel" id="company_company_roles">
            @includeIf('admin.contactCompanies.relationships.companyCompanyRoles', ['companyRoles' => $contactCompany->companyCompanyRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="manufacturer_equipment">
            @includeIf('admin.contactCompanies.relationships.manufacturerEquipment', ['equipment' => $contactCompany->manufacturerEquipment])
        </div>
        <div class="tab-pane" role="tabpanel" id="company_equipment_audits">
            @includeIf('admin.contactCompanies.relationships.companyEquipmentAudits', ['equipmentAudits' => $contactCompany->companyEquipmentAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_supplier_fabric_groups">
            @includeIf('admin.contactCompanies.relationships.primarySupplierFabricGroups', ['fabricGroups' => $contactCompany->primarySupplierFabricGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="company_bank_accounts">
            @includeIf('admin.contactCompanies.relationships.companyBankAccounts', ['bankAccounts' => $contactCompany->companyBankAccounts])
        </div>
        <div class="tab-pane" role="tabpanel" id="customer_fabric_nicknames">
            @includeIf('admin.contactCompanies.relationships.customerFabricNicknames', ['fabricNicknames' => $contactCompany->customerFabricNicknames])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_inspections">
            @includeIf('admin.contactCompanies.relationships.supplierInspections', ['inspections' => $contactCompany->supplierInspections])
        </div>
        <div class="tab-pane" role="tabpanel" id="customer_inspections">
            @includeIf('admin.contactCompanies.relationships.customerInspections', ['inspections' => $contactCompany->customerInspections])
        </div>
        <div class="tab-pane" role="tabpanel" id="shipping_agent_orders">
            @includeIf('admin.contactCompanies.relationships.shippingAgentOrders', ['orders' => $contactCompany->shippingAgentOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_supplier_audits">
            @includeIf('admin.contactCompanies.relationships.supplierSupplierAudits', ['supplierAudits' => $contactCompany->supplierSupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="client1_company_supplier_audits">
            @includeIf('admin.contactCompanies.relationships.client1CompanySupplierAudits', ['supplierAudits' => $contactCompany->client1CompanySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="client2_company_supplier_audits">
            @includeIf('admin.contactCompanies.relationships.client2CompanySupplierAudits', ['supplierAudits' => $contactCompany->client2CompanySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="client3_company_supplier_audits">
            @includeIf('admin.contactCompanies.relationships.client3CompanySupplierAudits', ['supplierAudits' => $contactCompany->client3CompanySupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="parent_company_contact_companies">
            @includeIf('admin.contactCompanies.relationships.parentCompanyContactCompanies', ['contactCompanies' => $contactCompany->parentCompanyContactCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_companies_documents">
            @includeIf('admin.contactCompanies.relationships.relatedCompaniesDocuments', ['documents' => $contactCompany->relatedCompaniesDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_suppliers_products">
            @includeIf('admin.contactCompanies.relationships.primarySuppliersProducts', ['products' => $contactCompany->primarySuppliersProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_supplier_component_parts">
            @includeIf('admin.contactCompanies.relationships.primarySupplierComponentParts', ['componentParts' => $contactCompany->primarySupplierComponentParts])
        </div>
    </div>
</div>

@endsection