@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.worldRegion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.world-regions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.worldRegion.fields.id') }}
                        </th>
                        <td>
                            {{ $worldRegion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worldRegion.fields.name') }}
                        </th>
                        <td>
                            {{ $worldRegion->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worldRegion.fields.notes') }}
                        </th>
                        <td>
                            {!! $worldRegion->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worldRegion.fields.wiki_url') }}
                        </th>
                        <td>
                            {{ $worldRegion->wiki_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.world-regions.index') }}">
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
            <a class="nav-link" href="#world_region_countries" role="tab" data-toggle="tab">
                {{ trans('cruds.country.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#world_region_bed_sizes_by_regions" role="tab" data-toggle="tab">
                {{ trans('cruds.bedSizesByRegion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="world_region_countries">
            @includeIf('admin.worldRegions.relationships.worldRegionCountries', ['countries' => $worldRegion->worldRegionCountries])
        </div>
        <div class="tab-pane" role="tabpanel" id="world_region_bed_sizes_by_regions">
            @includeIf('admin.worldRegions.relationships.worldRegionBedSizesByRegions', ['bedSizesByRegions' => $worldRegion->worldRegionBedSizesByRegions])
        </div>
    </div>
</div>

@endsection