@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bedSizeGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bed-size-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.name') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.price_group') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->price_group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.group_number') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->group_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.is_ukfr') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bedSizeGroup->is_ukfr ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_min_w_mm') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->mattress_min_w_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_max_w_mm') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->mattress_max_w_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_min_l_mm') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->mattress_min_l_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_max_l_mm') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->mattress_max_l_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.add_gl_approx_usd') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->add_gl_approx_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.add_pt_approx_usd') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->add_pt_approx_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.add_2_drawers_approx_usd') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->add_2_drawers_approx_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.add_mailorder_pkg_approx_usd') }}
                        </th>
                        <td>
                            {{ $bedSizeGroup->add_mailorder_pkg_approx_usd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.description') }}
                        </th>
                        <td>
                            {!! $bedSizeGroup->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bed-size-groups.index') }}">
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
            <a class="nav-link" href="#related_size_groups_bed_sizes_by_regions" role="tab" data-toggle="tab">
                {{ trans('cruds.bedSizesByRegion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="related_size_groups_bed_sizes_by_regions">
            @includeIf('admin.bedSizeGroups.relationships.relatedSizeGroupsBedSizesByRegions', ['bedSizesByRegions' => $bedSizeGroup->relatedSizeGroupsBedSizesByRegions])
        </div>
    </div>
</div>

@endsection