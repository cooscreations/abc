@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $productGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.name') }}
                        </th>
                        <td>
                            {{ $productGroup->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.description') }}
                        </th>
                        <td>
                            {!! $productGroup->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.logo') }}
                        </th>
                        <td>
                            @if($productGroup->logo)
                                <a href="{{ $productGroup->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productGroup->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.public_url') }}
                        </th>
                        <td>
                            {{ $productGroup->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.sharepoint_url') }}
                        </th>
                        <td>
                            {{ $productGroup->sharepoint_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.public_logo_url') }}
                        </th>
                        <td>
                            {{ $productGroup->public_logo_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productGroup.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productGroup->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-groups.index') }}">
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
            <a class="nav-link" href="#default_group_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#default_product_group_component_parts" role="tab" data-toggle="tab">
                {{ trans('cruds.componentPart.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_group_products">
            @includeIf('admin.productGroups.relationships.defaultGroupProducts', ['products' => $productGroup->defaultGroupProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="default_product_group_component_parts">
            @includeIf('admin.productGroups.relationships.defaultProductGroupComponentParts', ['componentParts' => $productGroup->defaultProductGroupComponentParts])
        </div>
    </div>
</div>

@endsection