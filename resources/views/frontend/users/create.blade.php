@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.users.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="approved" value="0">
                                <input type="checkbox" name="approved" id="approved" value="1" {{ old('approved', 0) == 1 ? 'checked' : '' }}>
                                <label for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                            </div>
                            @if($errors->has('approved'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('approved') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nda_sign_date">{{ trans('cruds.user.fields.nda_sign_date') }}</label>
                            <input class="form-control date" type="text" name="nda_sign_date" id="nda_sign_date" value="{{ old('nda_sign_date') }}">
                            @if($errors->has('nda_sign_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nda_sign_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.nda_sign_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="honesty_sign_date">{{ trans('cruds.user.fields.honesty_sign_date') }}</label>
                            <input class="form-control date" type="text" name="honesty_sign_date" id="honesty_sign_date" value="{{ old('honesty_sign_date') }}">
                            @if($errors->has('honesty_sign_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('honesty_sign_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.honesty_sign_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="private_notes">{{ trans('cruds.user.fields.private_notes') }}</label>
                            <textarea class="form-control" name="private_notes" id="private_notes">{{ old('private_notes') }}</textarea>
                            @if($errors->has('private_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('private_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.private_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_bio">{{ trans('cruds.user.fields.public_bio') }}</label>
                            <textarea class="form-control" name="public_bio" id="public_bio">{{ old('public_bio') }}</textarea>
                            @if($errors->has('public_bio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_bio') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.public_bio_helper') }}</span>
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