@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.fileType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.file-types.update", [$fileType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fileType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $fileType->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fileType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hex_color_code">{{ trans('cruds.fileType.fields.hex_color_code') }}</label>
                <input class="form-control {{ $errors->has('hex_color_code') ? 'is-invalid' : '' }}" type="text" name="hex_color_code" id="hex_color_code" value="{{ old('hex_color_code', $fileType->hex_color_code) }}">
                @if($errors->has('hex_color_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hex_color_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fileType.fields.hex_color_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.fileType.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $fileType->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fileType.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.fileType.fields.icon') }}</label>
                <input class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" type="text" name="icon" id="icon" value="{{ old('icon', $fileType->icon) }}">
                @if($errors->has('icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fileType.fields.icon_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection