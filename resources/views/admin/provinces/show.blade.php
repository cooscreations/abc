@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.province.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.id') }}
                        </th>
                        <td>
                            {{ $province->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.name') }}
                        </th>
                        <td>
                            {{ $province->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.local_name') }}
                        </th>
                        <td>
                            {{ $province->local_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.country') }}
                        </th>
                        <td>
                            {{ $province->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.description') }}
                        </th>
                        <td>
                            {!! $province->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
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
            <a class="nav-link" href="#province_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="province_addresses">
            @includeIf('admin.provinces.relationships.provinceAddresses', ['addresses' => $province->provinceAddresses])
        </div>
    </div>
</div>

@endsection