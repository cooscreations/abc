@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.companyOwnershipType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-ownership-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.companyOwnershipType.fields.id') }}
                        </th>
                        <td>
                            {{ $companyOwnershipType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyOwnershipType.fields.name') }}
                        </th>
                        <td>
                            {{ $companyOwnershipType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyOwnershipType.fields.description') }}
                        </th>
                        <td>
                            {{ $companyOwnershipType->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-ownership-types.index') }}">
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
            <a class="nav-link" href="#ownership_type_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ownership_type_contact_companies">
            @includeIf('admin.companyOwnershipTypes.relationships.ownershipTypeContactCompanies', ['contactCompanies' => $companyOwnershipType->ownershipTypeContactCompanies])
        </div>
    </div>
</div>

@endsection