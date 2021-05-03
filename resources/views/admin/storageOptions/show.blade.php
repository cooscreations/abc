@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.storageOption.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.storage-options.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.storageOption.fields.id') }}
                        </th>
                        <td>
                            {{ $storageOption->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storageOption.fields.name') }}
                        </th>
                        <td>
                            {{ $storageOption->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storageOption.fields.notes') }}
                        </th>
                        <td>
                            {!! $storageOption->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storageOption.fields.public_url') }}
                        </th>
                        <td>
                            {{ $storageOption->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.storageOption.fields.list_order') }}
                        </th>
                        <td>
                            {{ $storageOption->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.storage-options.index') }}">
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
            <a class="nav-link" href="#default_storage_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#storage_options_product_code_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.productCodeGroup.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_storage_products">
            @includeIf('admin.storageOptions.relationships.defaultStorageProducts', ['products' => $storageOption->defaultStorageProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="storage_options_product_code_groups">
            @includeIf('admin.storageOptions.relationships.storageOptionsProductCodeGroups', ['productCodeGroups' => $storageOption->storageOptionsProductCodeGroups])
        </div>
    </div>
</div>

@endsection