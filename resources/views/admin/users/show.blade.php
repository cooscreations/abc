@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.nda_sign_date') }}
                        </th>
                        <td>
                            {{ $user->nda_sign_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.honesty_sign_date') }}
                        </th>
                        <td>
                            {{ $user->honesty_sign_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.private_notes') }}
                        </th>
                        <td>
                            {{ $user->private_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.public_bio') }}
                        </th>
                        <td>
                            {{ $user->public_bio }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_afa_staffs" role="tab" data-toggle="tab">
                {{ trans('cruds.afaStaff.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#reports_to_afa_staffs" role="tab" data-toggle="tab">
                {{ trans('cruds.afaStaff.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_order_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.orderRole.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#manager_departments" role="tab" data-toggle="tab">
                {{ trans('cruds.department.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#inspector_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_users_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_contact_contacts">
            @includeIf('admin.users.relationships.userContactContacts', ['contactContacts' => $user->userContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_afa_staffs">
            @includeIf('admin.users.relationships.userAfaStaffs', ['afaStaffs' => $user->userAfaStaffs])
        </div>
        <div class="tab-pane" role="tabpanel" id="reports_to_afa_staffs">
            @includeIf('admin.users.relationships.reportsToAfaStaffs', ['afaStaffs' => $user->reportsToAfaStaffs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_order_roles">
            @includeIf('admin.users.relationships.userOrderRoles', ['orderRoles' => $user->userOrderRoles])
        </div>
        <div class="tab-pane" role="tabpanel" id="manager_departments">
            @includeIf('admin.users.relationships.managerDepartments', ['departments' => $user->managerDepartments])
        </div>
        <div class="tab-pane" role="tabpanel" id="inspector_supplier_audits">
            @includeIf('admin.users.relationships.inspectorSupplierAudits', ['supplierAudits' => $user->inspectorSupplierAudits])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_users_documents">
            @includeIf('admin.users.relationships.relatedUsersDocuments', ['documents' => $user->relatedUsersDocuments])
        </div>
    </div>
</div>

@endsection