@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.id') }}
                        </th>
                        <td>
                            {{ $productType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.name') }}
                        </th>
                        <td>
                            {{ $productType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.description') }}
                        </th>
                        <td>
                            {{ $productType->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.public_url') }}
                        </th>
                        <td>
                            {{ $productType->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.public_icon_url') }}
                        </th>
                        <td>
                            {{ $productType->public_icon_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productType->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
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
            <a class="nav-link" href="#product_type_product_code_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.productCodeGroup.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client1_product_type_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_type_product_code_groups">
            @includeIf('admin.productTypes.relationships.productTypeProductCodeGroups', ['productCodeGroups' => $productType->productTypeProductCodeGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="client1_product_type_supplier_audits">
            @includeIf('admin.productTypes.relationships.client1ProductTypeSupplierAudits', ['supplierAudits' => $productType->client1ProductTypeSupplierAudits])
        </div>
    </div>
</div>

@endsection