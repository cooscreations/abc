@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.packagingType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packaging-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.packagingType.fields.id') }}
                        </th>
                        <td>
                            {{ $packagingType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packagingType.fields.name') }}
                        </th>
                        <td>
                            {{ $packagingType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packagingType.fields.primary_material') }}
                        </th>
                        <td>
                            {{ $packagingType->primary_material->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packagingType.fields.description') }}
                        </th>
                        <td>
                            {!! $packagingType->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packaging-types.index') }}">
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
            <a class="nav-link" href="#type_packagings" role="tab" data-toggle="tab">
                {{ trans('cruds.packaging.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#packaging_type_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="type_packagings">
            @includeIf('admin.packagingTypes.relationships.typePackagings', ['packagings' => $packagingType->typePackagings])
        </div>
        <div class="tab-pane" role="tabpanel" id="packaging_type_orders">
            @includeIf('admin.packagingTypes.relationships.packagingTypeOrders', ['orders' => $packagingType->packagingTypeOrders])
        </div>
    </div>
</div>

@endsection