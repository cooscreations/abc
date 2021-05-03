@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactContact.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-contacts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.id') }}
                        </th>
                        <td>
                            {{ $contactContact->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.user') }}
                        </th>
                        <td>
                            {{ $contactContact->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.title') }}
                        </th>
                        <td>
                            {{ $contactContact->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_first_name') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_last_name') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.full_name') }}
                        </th>
                        <td>
                            {{ $contactContact->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.local_name') }}
                        </th>
                        <td>
                            {{ $contactContact->local_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.country_of_birth') }}
                        </th>
                        <td>
                            {{ $contactContact->country_of_birth->alpha_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.primary_address') }}
                        </th>
                        <td>
                            {{ $contactContact->primary_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.current_country') }}
                        </th>
                        <td>
                            {{ $contactContact->current_country->alpha_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.company') }}
                        </th>
                        <td>
                            {{ $contactContact->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.photo') }}
                        </th>
                        <td>
                            @if($contactContact->photo)
                                <a href="{{ $contactContact->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contactContact->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.wechat') }}
                        </th>
                        <td>
                            {{ $contactContact->wechat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.linkedin_url') }}
                        </th>
                        <td>
                            {{ $contactContact->linkedin_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.facebook_url') }}
                        </th>
                        <td>
                            {{ $contactContact->facebook_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.personal_email') }}
                        </th>
                        <td>
                            {{ $contactContact->personal_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.office_phone') }}
                        </th>
                        <td>
                            {{ $contactContact->office_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.mobile_phone') }}
                        </th>
                        <td>
                            {{ $contactContact->mobile_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.personal_url') }}
                        </th>
                        <td>
                            {{ $contactContact->personal_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $contactContact->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.business_card') }}
                        </th>
                        <td>
                            @foreach($contactContact->business_card as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.qr_code') }}
                        </th>
                        <td>
                            @if($contactContact->qr_code)
                                <a href="{{ $contactContact->qr_code->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contactContact->qr_code->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.default_language') }}
                        </th>
                        <td>
                            {{ $contactContact->default_language->alpha_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.roles') }}
                        </th>
                        <td>
                            @foreach($contactContact->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.nda_signed_date') }}
                        </th>
                        <td>
                            {{ $contactContact->nda_signed_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.honesty_agreement_signed_date') }}
                        </th>
                        <td>
                            {{ $contactContact->honesty_agreement_signed_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-contacts.index') }}">
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
            <a class="nav-link" href="#owner_contact_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_placed_by_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact_order_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.orderRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact_company_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.companyRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sales_person_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_contacts_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="owner_contact_contact_companies">
            @includeIf('admin.contactContacts.relationships.ownerContactContactCompanies', ['contactCompanies' => $contactContact->ownerContactContactCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_placed_by_orders">
            @includeIf('admin.contactContacts.relationships.orderPlacedByOrders', ['orders' => $contactContact->orderPlacedByOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="contact_order_roles">
            @includeIf('admin.contactContacts.relationships.contactOrderRoles', ['orderRoles' => $contactContact->contactOrderRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="contact_company_roles">
            @includeIf('admin.contactContacts.relationships.contactCompanyRoles', ['companyRoles' => $contactContact->contactCompanyRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="sales_person_orders">
            @includeIf('admin.contactContacts.relationships.salesPersonOrders', ['orders' => $contactContact->salesPersonOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_contacts_documents">
            @includeIf('admin.contactContacts.relationships.relatedContactsDocuments', ['documents' => $contactContact->relatedContactsDocuments])
        </div>
    </div>
</div>

@endsection