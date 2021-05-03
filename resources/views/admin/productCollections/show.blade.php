@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productCollection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-collections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.id') }}
                        </th>
                        <td>
                            {{ $productCollection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.name') }}
                        </th>
                        <td>
                            {{ $productCollection->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.public_logo_url') }}
                        </th>
                        <td>
                            {{ $productCollection->public_logo_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.public_url') }}
                        </th>
                        <td>
                            {{ $productCollection->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.share_point_url') }}
                        </th>
                        <td>
                            {{ $productCollection->share_point_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productCollection.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productCollection->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-collections.index') }}">
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
            <a class="nav-link" href="#product_collection_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_collection_product_code_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.productCodeGroup.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_collection_products">
            @includeIf('admin.productCollections.relationships.productCollectionProducts', ['products' => $productCollection->productCollectionProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_collection_product_code_groups">
            @includeIf('admin.productCollections.relationships.productCollectionProductCodeGroups', ['productCodeGroups' => $productCollection->productCollectionProductCodeGroups])
        </div>
    </div>
</div>

@endsection