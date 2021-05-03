@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.fabricGroup.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fabric-groups.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.afa_fabric_group_code') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->afa_fabric_group_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.primary_supplier') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->primary_supplier->company_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.primary_supplier_group_code') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->primary_supplier_group_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.sharepoint_url') }}
                                    </th>
                                    <td>
                                        {{ $fabricGroup->sharepoint_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $fabricGroup->description !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fabric-groups.index') }}">
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