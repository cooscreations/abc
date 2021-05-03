@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.inspectionStatus.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.inspection-statuses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.inspectionStatus.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $inspectionStatus->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.inspectionStatus.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $inspectionStatus->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.inspectionStatus.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $inspectionStatus->list_order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.inspectionStatus.fields.status_color_hex') }}
                                    </th>
                                    <td>
                                        {{ $inspectionStatus->status_color_hex }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.inspectionStatus.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $inspectionStatus->description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.inspection-statuses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection