@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.complaint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.id') }}
                        </th>
                        <td>
                            {{ $complaint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.afa_case_number') }}
                        </th>
                        <td>
                            {{ $complaint->afa_case_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.qty_affected') }}
                        </th>
                        <td>
                            {{ $complaint->qty_affected }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection