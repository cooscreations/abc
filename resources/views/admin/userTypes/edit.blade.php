@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-types.update", [$userType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.userType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $userType->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.userType.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="text" name="list_order" id="list_order" value="{{ old('list_order', $userType->list_order) }}">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userType.fields.list_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="auth_level">{{ trans('cruds.userType.fields.auth_level') }}</label>
                <input class="form-control {{ $errors->has('auth_level') ? 'is-invalid' : '' }}" type="text" name="auth_level" id="auth_level" value="{{ old('auth_level', $userType->auth_level) }}">
                @if($errors->has('auth_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auth_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userType.fields.auth_level_helper') }}</span>
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