@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.yesNoMaybe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.yes-no-maybes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.yesNoMaybe.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.yesNoMaybe.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.yesNoMaybe.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.yesNoMaybe.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_css_class">{{ trans('cruds.yesNoMaybe.fields.default_css_class') }}</label>
                <input class="form-control {{ $errors->has('default_css_class') ? 'is-invalid' : '' }}" type="text" name="default_css_class" id="default_css_class" value="{{ old('default_css_class', '') }}">
                @if($errors->has('default_css_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_css_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.yesNoMaybe.fields.default_css_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.yesNoMaybe.fields.icon') }}</label>
                <input class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" type="text" name="icon" id="icon" value="{{ old('icon', '') }}">
                @if($errors->has('icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.yesNoMaybe.fields.icon_helper') }}</span>
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