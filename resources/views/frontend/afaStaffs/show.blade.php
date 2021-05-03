@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.afaStaff.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.afa-staffs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.full_name') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->full_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.staff_level') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->staff_level->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.reports_to') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->reports_to->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.date_started') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->date_started }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.date_finished') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->date_finished }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.staff_bio') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->staff_bio }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.afaStaff.fields.department') }}
                                    </th>
                                    <td>
                                        {{ $afaStaff->department->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.afa-staffs.index') }}">
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