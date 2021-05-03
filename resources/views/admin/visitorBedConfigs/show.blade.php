@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.visitorBedConfig.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitor-bed-configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorBedConfig.fields.id') }}
                        </th>
                        <td>
                            {{ $visitorBedConfig->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorBedConfig.fields.name') }}
                        </th>
                        <td>
                            {{ $visitorBedConfig->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorBedConfig.fields.notes') }}
                        </th>
                        <td>
                            {!! $visitorBedConfig->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorBedConfig.fields.public_url') }}
                        </th>
                        <td>
                            {{ $visitorBedConfig->public_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitor-bed-configs.index') }}">
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
            <a class="nav-link" href="#default_visitor_config_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_visitor_config_products">
            @includeIf('admin.visitorBedConfigs.relationships.defaultVisitorConfigProducts', ['products' => $visitorBedConfig->defaultVisitorConfigProducts])
        </div>
    </div>
</div>

@endsection