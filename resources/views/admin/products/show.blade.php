@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.afa_model_number') }}
                        </th>
                        <td>
                            {{ $product->afa_model_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.primary_nickname') }}
                        </th>
                        <td>
                            {{ $product->primary_nickname->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.product_code_group') }}
                        </th>
                        <td>
                            {{ $product->product_code_group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_function') }}
                        </th>
                        <td>
                            {{ $product->default_function->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.product_collection') }}
                        </th>
                        <td>
                            {{ $product->product_collection->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_group') }}
                        </th>
                        <td>
                            {{ $product->default_group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_storage') }}
                        </th>
                        <td>
                            {{ $product->default_storage->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_gas_lift_config') }}
                        </th>
                        <td>
                            {{ $product->default_gas_lift_config->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_drawer_config') }}
                        </th>
                        <td>
                            {{ $product->default_drawer_config->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_drawer_movement') }}
                        </th>
                        <td>
                            {{ $product->default_drawer_movement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_tv_config') }}
                        </th>
                        <td>
                            {{ $product->default_tv_config->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.default_visitor_config') }}
                        </th>
                        <td>
                            {{ $product->default_visitor_config->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.extra_letters_used_in_sku') }}
                        </th>
                        <td>
                            @foreach($product->extra_letters_used_in_skus as $key => $extra_letters_used_in_sku)
                                <span class="label label-info">{{ $extra_letters_used_in_sku->letter_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.primary_material') }}
                        </th>
                        <td>
                            {{ $product->primary_material->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.date_launched') }}
                        </th>
                        <td>
                            {{ $product->date_launched }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.primary_suppliers') }}
                        </th>
                        <td>
                            @foreach($product->primary_suppliers as $key => $primary_suppliers)
                                <span class="label label-info">{{ $primary_suppliers->company_short_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.std_qty_feet') }}
                        </th>
                        <td>
                            {{ $product->std_qty_feet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.std_qty_boxes') }}
                        </th>
                        <td>
                            {{ $product->std_qty_boxes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.std_packaging') }}
                        </th>
                        <td>
                            {{ $product->std_packaging->notes ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.beauty_shot') }}
                        </th>
                        <td>
                            @if($product->beauty_shot)
                                <a href="{{ $product->beauty_shot->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->beauty_shot->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.iso_naked') }}
                        </th>
                        <td>
                            @if($product->iso_naked)
                                <a href="{{ $product->iso_naked->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->iso_naked->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.public_description') }}
                        </th>
                        <td>
                            {!! $product->public_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $product->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.other_photos') }}
                        </th>
                        <td>
                            @foreach($product->other_photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
            <a class="nav-link" href="#product_product_nicknames" role="tab" data-toggle="tab">
                {{ trans('cruds.productNickname.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_product_skus" role="tab" data-toggle="tab">
                {{ trans('cruds.productSku.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_order_items" role="tab" data-toggle="tab">
                {{ trans('cruds.orderItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_packagings" role="tab" data-toggle="tab">
                {{ trans('cruds.packaging.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_products_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_product_nicknames">
            @includeIf('admin.products.relationships.productProductNicknames', ['productNicknames' => $product->productProductNicknames])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_product_skus">
            @includeIf('admin.products.relationships.productProductSkus', ['productSkus' => $product->productProductSkus])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_order_items">
            @includeIf('admin.products.relationships.productOrderItems', ['orderItems' => $product->productOrderItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_packagings">
            @includeIf('admin.products.relationships.productPackagings', ['packagings' => $product->productPackagings])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_products_documents">
            @includeIf('admin.products.relationships.relatedProductsDocuments', ['documents' => $product->relatedProductsDocuments])
        </div>
    </div>
</div>

@endsection