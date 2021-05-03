@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.companyType.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.company-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $companyType->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $companyType->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $companyType->notes !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $companyType->list_order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.icon') }}
                                    </th>
                                    <td>
                                        {{ $companyType->icon }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.company-types.index') }}">
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