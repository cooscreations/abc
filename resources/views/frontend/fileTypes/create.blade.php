@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.fileType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.file-types.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.fileType.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileType.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hex_color_code">{{ trans('cruds.fileType.fields.hex_color_code') }}</label>
                            <input class="form-control" type="text" name="hex_color_code" id="hex_color_code" value="{{ old('hex_color_code', '') }}">
                            @if($errors->has('hex_color_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hex_color_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileType.fields.hex_color_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.fileType.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fileType.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="icon">{{ trans('cruds.fileType.fields.icon') }}</label>
                            <input class="form-control" type="text" name="icon" id="icon" value="{{ old('icon', '') }}">
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

        </div>
    </div>
</div>
@endsection