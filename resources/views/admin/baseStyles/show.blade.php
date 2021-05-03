@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.baseStyle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.base-styles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.baseStyle.fields.id') }}
                        </th>
                        <td>
                            {{ $baseStyle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.baseStyle.fields.name') }}
                        </th>
                        <td>
                            {{ $baseStyle->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.baseStyle.fields.description') }}
                        </th>
                        <td>
                            {{ $baseStyle->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.base-styles.index') }}">
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
            <a class="nav-link" href="#base_style_bed_sizes_by_regions" role="tab" data-toggle="tab">
                {{ trans('cruds.bedSizesByRegion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="base_style_bed_sizes_by_regions">
            @includeIf('admin.baseStyles.relationships.baseStyleBedSizesByRegions', ['bedSizesByRegions' => $baseStyle->baseStyleBedSizesByRegions])
        </div>
    </div>
</div>

@endsection