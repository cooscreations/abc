@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tvBedConfig.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tv-bed-configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tvBedConfig.fields.id') }}
                        </th>
                        <td>
                            {{ $tvBedConfig->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tvBedConfig.fields.name') }}
                        </th>
                        <td>
                            {{ $tvBedConfig->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tvBedConfig.fields.notes') }}
                        </th>
                        <td>
                            {!! $tvBedConfig->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tvBedConfig.fields.public_url') }}
                        </th>
                        <td>
                            {{ $tvBedConfig->public_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tv-bed-configs.index') }}">
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
            <a class="nav-link" href="#default_tv_config_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_tv_config_products">
            @includeIf('admin.tvBedConfigs.relationships.defaultTvConfigProducts', ['products' => $tvBedConfig->defaultTvConfigProducts])
        </div>
    </div>
</div>

@endsection