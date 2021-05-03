@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bedSizesByRegion.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bed-sizes-by-regions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.size_code') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->size_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.world_region') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->world_region->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.size_name') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->size_name->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.base_style') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->base_style->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.related_size_groups') }}
                                    </th>
                                    <td>
                                        @foreach($bedSizesByRegion->related_size_groups as $key => $related_size_groups)
                                            <span class="label label-info">{{ $related_size_groups->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.mattress_w_mm') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->mattress_w_mm }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.mattress_l_mm') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->mattress_l_mm }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.imperial_l_ft_in') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->imperial_l_ft_in }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.imperial_w_ft_in') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->imperial_w_ft_in }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.imperial_nickname') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->imperial_nickname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bedSizesByRegion.fields.plank_approx_extra_usd') }}
                                    </th>
                                    <td>
                                        {{ $bedSizesByRegion->plank_approx_extra_usd }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bed-sizes-by-regions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection