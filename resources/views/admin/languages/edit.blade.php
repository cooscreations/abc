@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.language.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.languages.update", [$language->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.language.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $language->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alpha_2">{{ trans('cruds.language.fields.alpha_2') }}</label>
                <input class="form-control {{ $errors->has('alpha_2') ? 'is-invalid' : '' }}" type="text" name="alpha_2" id="alpha_2" value="{{ old('alpha_2', $language->alpha_2) }}">
                @if($errors->has('alpha_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alpha_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.alpha_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="local_name">{{ trans('cruds.language.fields.local_name') }}</label>
                <input class="form-control {{ $errors->has('local_name') ? 'is-invalid' : '' }}" type="text" name="local_name" id="local_name" value="{{ old('local_name', $language->local_name) }}">
                @if($errors->has('local_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('local_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.local_name_helper') }}</span>
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