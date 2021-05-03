@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.department.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.departments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $department->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $department->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.dept_code') }}
                                    </th>
                                    <td>
                                        {{ $department->dept_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.icon') }}
                                    </th>
                                    <td>
                                        @if($department->icon)
                                            <a href="{{ $department->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $department->icon->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.hex_color') }}
                                    </th>
                                    <td>
                                        {{ $department->hex_color }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.dept_intro') }}
                                    </th>
                                    <td>
                                        {!! $department->dept_intro !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.department.fields.manager') }}
                                    </th>
                                    <td>
                                        {{ $department->manager->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.departments.index') }}">
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