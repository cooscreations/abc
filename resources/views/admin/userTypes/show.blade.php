@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.id') }}
                        </th>
                        <td>
                            {{ $userType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.name') }}
                        </th>
                        <td>
                            {{ $userType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.list_order') }}
                        </th>
                        <td>
                            {{ $userType->list_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.auth_level') }}
                        </th>
                        <td>
                            {{ $userType->auth_level }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-types.index') }}">
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
            <a class="nav-link" href="#authorised_user_types_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="authorised_user_types_documents">
            @includeIf('admin.userTypes.relationships.authorisedUserTypesDocuments', ['documents' => $userType->authorisedUserTypesDocuments])
        </div>
    </div>
</div>

@endsection