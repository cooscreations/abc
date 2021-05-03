@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.materialFinish.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.material-finishes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.materialFinish.fields.id') }}
                        </th>
                        <td>
                            {{ $materialFinish->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialFinish.fields.name') }}
                        </th>
                        <td>
                            {{ $materialFinish->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialFinish.fields.notes') }}
                        </th>
                        <td>
                            {!! $materialFinish->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialFinish.fields.photos') }}
                        </th>
                        <td>
                            @foreach($materialFinish->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.material-finishes.index') }}">
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
            <a class="nav-link" href="#std_material_finish_raw_materials" role="tab" data-toggle="tab">
                {{ trans('cruds.rawMaterial.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="std_material_finish_raw_materials">
            @includeIf('admin.materialFinishes.relationships.stdMaterialFinishRawMaterials', ['rawMaterials' => $materialFinish->stdMaterialFinishRawMaterials])
        </div>
    </div>
</div>

@endsection