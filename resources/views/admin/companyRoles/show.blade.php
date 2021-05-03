@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.companyRole.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.companyRole.fields.id') }}
                        </th>
                        <td>
                            {{ $companyRole->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyRole.fields.company') }}
                        </th>
                        <td>
                            {{ $companyRole->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyRole.fields.role') }}
                        </th>
                        <td>
                            {{ $companyRole->role->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyRole.fields.contact') }}
                        </th>
                        <td>
                            {{ $companyRole->contact->contact_first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection