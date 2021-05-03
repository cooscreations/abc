@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rawMaterialType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.raw-material-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterialType.fields.id') }}
                        </th>
                        <td>
                            {{ $rawMaterialType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterialType.fields.name') }}
                        </th>
                        <td>
                            {{ $rawMaterialType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterialType.fields.notes') }}
                        </th>
                        <td>
                            {!! $rawMaterialType->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rawMaterialType.fields.public_url') }}
                        </th>
                        <td>
                            {{ $rawMaterialType->public_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.raw-material-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection