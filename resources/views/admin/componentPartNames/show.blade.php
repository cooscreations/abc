@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.componentPartName.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.component-part-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPartName.fields.id') }}
                        </th>
                        <td>
                            {{ $componentPartName->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPartName.fields.name') }}
                        </th>
                        <td>
                            {{ $componentPartName->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPartName.fields.short_name') }}
                        </th>
                        <td>
                            {{ $componentPartName->short_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPartName.fields.photo') }}
                        </th>
                        <td>
                            @foreach($componentPartName->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.component-part-names.index') }}">
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
            <a class="nav-link" href="#component_part_name_component_parts" role="tab" data-toggle="tab">
                {{ trans('cruds.componentPart.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="component_part_name_component_parts">
            @includeIf('admin.componentPartNames.relationships.componentPartNameComponentParts', ['componentParts' => $componentPartName->componentPartNameComponentParts])
        </div>
    </div>
</div>

@endsection