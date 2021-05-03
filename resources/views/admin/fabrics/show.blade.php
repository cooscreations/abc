@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fabric.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fabrics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fabric.fields.id') }}
                        </th>
                        <td>
                            {{ $fabric->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabric.fields.name') }}
                        </th>
                        <td>
                            {{ $fabric->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabric.fields.fabric_group') }}
                        </th>
                        <td>
                            {{ $fabric->fabric_group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabric.fields.fabric_code') }}
                        </th>
                        <td>
                            {{ $fabric->fabric_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fabrics.index') }}">
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
            <a class="nav-link" href="#fabric_fabric_nicknames" role="tab" data-toggle="tab">
                {{ trans('cruds.fabricNickname.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="fabric_fabric_nicknames">
            @includeIf('admin.fabrics.relationships.fabricFabricNicknames', ['fabricNicknames' => $fabric->fabricFabricNicknames])
        </div>
    </div>
</div>

@endsection