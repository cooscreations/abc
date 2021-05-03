@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rawMaterial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.raw-materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.id') }}
                        </th>
                        <td>
                            {{ $rawMaterial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.name') }}
                        </th>
                        <td>
                            {{ $rawMaterial->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.notes') }}
                        </th>
                        <td>
                            {!! $rawMaterial->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.is_vegan') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_vegan ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.is_sustainable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_sustainable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.is_ukfr_std') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_ukfr_std ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.is_ukfr_treatable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_ukfr_treatable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.std_material_finish') }}
                        </th>
                        <td>
                            {{ $rawMaterial->std_material_finish->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.raw-materials.index') }}">
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
            <a class="nav-link" href="#primary_material_packaging_types" role="tab" data-toggle="tab">
                {{ trans('cruds.packagingType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#default_raw_material_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.price.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_material_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#raw_material_component_parts" role="tab" data-toggle="tab">
                {{ trans('cruds.componentPart.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#primary_materials_supplier_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.supplierAudit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="primary_material_packaging_types">
            @includeIf('admin.rawMaterials.relationships.primaryMaterialPackagingTypes', ['packagingTypes' => $rawMaterial->primaryMaterialPackagingTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="default_raw_material_prices">
            @includeIf('admin.rawMaterials.relationships.defaultRawMaterialPrices', ['prices' => $rawMaterial->defaultRawMaterialPrices])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_material_products">
            @includeIf('admin.rawMaterials.relationships.primaryMaterialProducts', ['products' => $rawMaterial->primaryMaterialProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="raw_material_component_parts">
            @includeIf('admin.rawMaterials.relationships.rawMaterialComponentParts', ['componentParts' => $rawMaterial->rawMaterialComponentParts])
        </div>
        <div class="tab-pane" role="tabpanel" id="primary_materials_supplier_audits">
            @includeIf('admin.rawMaterials.relationships.primaryMaterialsSupplierAudits', ['supplierAudits' => $rawMaterial->primaryMaterialsSupplierAudits])
        </div>
    </div>
</div>

@endsection