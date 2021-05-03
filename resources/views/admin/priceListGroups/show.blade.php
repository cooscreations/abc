@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.priceListGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-list-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $priceListGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListGroup.fields.name') }}
                        </th>
                        <td>
                            {{ $priceListGroup->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListGroup.fields.description') }}
                        </th>
                        <td>
                            {{ $priceListGroup->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListGroup.fields.code') }}
                        </th>
                        <td>
                            {{ $priceListGroup->code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-list-groups.index') }}">
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
            <a class="nav-link" href="#group_price_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.priceList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#price_group_bed_size_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.bedSizeGroup.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="group_price_lists">
            @includeIf('admin.priceListGroups.relationships.groupPriceLists', ['priceLists' => $priceListGroup->groupPriceLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="price_group_bed_size_groups">
            @includeIf('admin.priceListGroups.relationships.priceGroupBedSizeGroups', ['bedSizeGroups' => $priceListGroup->priceGroupBedSizeGroups])
        </div>
    </div>
</div>

@endsection