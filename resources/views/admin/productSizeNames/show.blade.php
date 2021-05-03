@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productSizeName.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-size-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productSizeName.fields.id') }}
                        </th>
                        <td>
                            {{ $productSizeName->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSizeName.fields.name') }}
                        </th>
                        <td>
                            {{ $productSizeName->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSizeName.fields.code') }}
                        </th>
                        <td>
                            {{ $productSizeName->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSizeName.fields.description') }}
                        </th>
                        <td>
                            {{ $productSizeName->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSizeName.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productSizeName->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-size-names.index') }}">
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
            <a class="nav-link" href="#size_name_bed_sizes_by_regions" role="tab" data-toggle="tab">
                {{ trans('cruds.bedSizesByRegion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="size_name_bed_sizes_by_regions">
            @includeIf('admin.productSizeNames.relationships.sizeNameBedSizesByRegions', ['bedSizesByRegions' => $productSizeName->sizeNameBedSizesByRegions])
        </div>
    </div>
</div>

@endsection