@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productSku.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-skus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productSku.fields.id') }}
                        </th>
                        <td>
                            {{ $productSku->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSku.fields.product_sku') }}
                        </th>
                        <td>
                            {{ $productSku->product_sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSku.fields.product') }}
                        </th>
                        <td>
                            {{ $productSku->product->afa_model_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSku.fields.prod_dev_stage') }}
                        </th>
                        <td>
                            {{ $productSku->prod_dev_stage->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSku.fields.size') }}
                        </th>
                        <td>
                            {{ $productSku->size->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-skus.index') }}">
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
            <a class="nav-link" href="#sku_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.price.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_sku_component_parts" role="tab" data-toggle="tab">
                {{ trans('cruds.componentPart.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_sku_order_items" role="tab" data-toggle="tab">
                {{ trans('cruds.orderItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_sku_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sku_prices">
            @includeIf('admin.productSkus.relationships.skuPrices', ['prices' => $productSku->skuPrices])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_sku_component_parts">
            @includeIf('admin.productSkus.relationships.productSkuComponentParts', ['componentParts' => $productSku->productSkuComponentParts])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_sku_order_items">
            @includeIf('admin.productSkus.relationships.productSkuOrderItems', ['orderItems' => $productSku->productSkuOrderItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_sku_documents">
            @includeIf('admin.productSkus.relationships.relatedSkuDocuments', ['documents' => $productSku->relatedSkuDocuments])
        </div>
    </div>
</div>

@endsection