@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
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
            <a class="nav-link" href="#role_order_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.orderRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#role_company_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.companyRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#roles_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="role_order_roles">
            @includeIf('admin.roles.relationships.roleOrderRoles', ['orderRoles' => $role->roleOrderRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="role_company_roles">
            @includeIf('admin.roles.relationships.roleCompanyRoles', ['companyRoles' => $role->roleCompanyRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="roles_contact_contacts">
            @includeIf('admin.roles.relationships.rolesContactContacts', ['contactContacts' => $role->rolesContactContacts])
        </div>
    </div>
</div>

@endsection