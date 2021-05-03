@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.complaintStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaint-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $complaintStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintStatus.fields.name') }}
                        </th>
                        <td>
                            {{ $complaintStatus->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintStatus.fields.description') }}
                        </th>
                        <td>
                            {{ $complaintStatus->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintStatus.fields.list_order') }}
                        </th>
                        <td>
                            {{ $complaintStatus->list_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintStatus.fields.color_code') }}
                        </th>
                        <td>
                            {{ $complaintStatus->color_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaint-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection