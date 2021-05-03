@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fileType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.file-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fileType.fields.id') }}
                        </th>
                        <td>
                            {{ $fileType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fileType.fields.name') }}
                        </th>
                        <td>
                            {{ $fileType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fileType.fields.hex_color_code') }}
                        </th>
                        <td>
                            {{ $fileType->hex_color_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fileType.fields.description') }}
                        </th>
                        <td>
                            {{ $fileType->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fileType.fields.icon') }}
                        </th>
                        <td>
                            {{ $fileType->icon }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.file-types.index') }}">
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
            <a class="nav-link" href="#file_type_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="file_type_documents">
            @includeIf('admin.fileTypes.relationships.fileTypeDocuments', ['documents' => $fileType->fileTypeDocuments])
        </div>
    </div>
</div>

@endsection