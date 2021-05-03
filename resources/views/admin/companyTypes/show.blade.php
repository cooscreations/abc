@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.companyType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.companyType.fields.id') }}
                        </th>
                        <td>
                            {{ $companyType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyType.fields.name') }}
                        </th>
                        <td>
                            {{ $companyType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyType.fields.notes') }}
                        </th>
                        <td>
                            {!! $companyType->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyType.fields.list_order') }}
                        </th>
                        <td>
                            {{ $companyType->list_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyType.fields.icon') }}
                        </th>
                        <td>
                            {{ $companyType->icon }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-types.index') }}">
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
            <a class="nav-link" href="#primary_company_type_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="primary_company_type_contact_companies">
            @includeIf('admin.companyTypes.relationships.primaryCompanyTypeContactCompanies', ['contactCompanies' => $companyType->primaryCompanyTypeContactCompanies])
        </div>
    </div>
</div>

@endsection