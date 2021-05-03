@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gasLiftConfig.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gas-lift-configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gasLiftConfig.fields.id') }}
                        </th>
                        <td>
                            {{ $gasLiftConfig->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gasLiftConfig.fields.name') }}
                        </th>
                        <td>
                            {{ $gasLiftConfig->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gasLiftConfig.fields.notes') }}
                        </th>
                        <td>
                            {!! $gasLiftConfig->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gasLiftConfig.fields.public_url') }}
                        </th>
                        <td>
                            {{ $gasLiftConfig->public_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gas-lift-configs.index') }}">
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
            <a class="nav-link" href="#default_gas_lift_config_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_gas_lift_config_products">
            @includeIf('admin.gasLiftConfigs.relationships.defaultGasLiftConfigProducts', ['products' => $gasLiftConfig->defaultGasLiftConfigProducts])
        </div>
    </div>
</div>

@endsection