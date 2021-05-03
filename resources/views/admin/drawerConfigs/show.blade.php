@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.drawerConfig.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drawer-configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.drawerConfig.fields.id') }}
                        </th>
                        <td>
                            {{ $drawerConfig->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drawerConfig.fields.name') }}
                        </th>
                        <td>
                            {{ $drawerConfig->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drawerConfig.fields.notes') }}
                        </th>
                        <td>
                            {!! $drawerConfig->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drawerConfig.fields.public_url') }}
                        </th>
                        <td>
                            {{ $drawerConfig->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drawerConfig.fields.photo') }}
                        </th>
                        <td>
                            @if($drawerConfig->photo)
                                <a href="{{ $drawerConfig->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $drawerConfig->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drawer-configs.index') }}">
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
            <a class="nav-link" href="#default_drawer_config_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_drawer_config_products">
            @includeIf('admin.drawerConfigs.relationships.defaultDrawerConfigProducts', ['products' => $drawerConfig->defaultDrawerConfigProducts])
        </div>
    </div>
</div>

@endsection