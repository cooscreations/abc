@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productFunction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-functions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productFunction.fields.id') }}
                        </th>
                        <td>
                            {{ $productFunction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productFunction.fields.name') }}
                        </th>
                        <td>
                            {{ $productFunction->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productFunction.fields.description') }}
                        </th>
                        <td>
                            {{ $productFunction->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productFunction.fields.public_icon_url') }}
                        </th>
                        <td>
                            {{ $productFunction->public_icon_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productFunction.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productFunction->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-functions.index') }}">
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
            <a class="nav-link" href="#default_function_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_function_product_code_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.productCodeGroup.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_function_products">
            @includeIf('admin.productFunctions.relationships.defaultFunctionProducts', ['products' => $productFunction->defaultFunctionProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_function_product_code_groups">
            @includeIf('admin.productFunctions.relationships.productFunctionProductCodeGroups', ['productCodeGroups' => $productFunction->productFunctionProductCodeGroups])
        </div>
    </div>
</div>

@endsection