@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.language.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.id') }}
                        </th>
                        <td>
                            {{ $language->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.name') }}
                        </th>
                        <td>
                            {{ $language->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.alpha_2') }}
                        </th>
                        <td>
                            {{ $language->alpha_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.local_name') }}
                        </th>
                        <td>
                            {{ $language->local_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
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
            <a class="nav-link" href="#default_language_contact_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contactContact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_language_contact_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.contactCompany.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_language_contact_contacts">
            @includeIf('admin.languages.relationships.defaultLanguageContactContacts', ['contactContacts' => $language->defaultLanguageContactContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_language_contact_companies">
            @includeIf('admin.languages.relationships.primaryLanguageContactCompanies', ['contactCompanies' => $language->primaryLanguageContactCompanies])
        </div>
    </div>
</div>

@endsection