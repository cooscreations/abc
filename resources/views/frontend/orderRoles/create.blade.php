@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.orderRole.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.order-roles.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="order_id">{{ trans('cruds.orderRole.fields.order') }}</label>
                            <select class="form-control select2" name="order_id" id="order_id">
                                @foreach($orders as $id => $entry)
                                    <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderRole.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="role_id">{{ trans('cruds.orderRole.fields.role') }}</label>
                            <select class="form-control select2" name="role_id" id="role_id">
                                @foreach($roles as $id => $entry)
                                    <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderRole.fields.role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_id">{{ trans('cruds.orderRole.fields.contact') }}</label>
                            <select class="form-control select2" name="contact_id" id="contact_id">
                                @foreach($contacts as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contact_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderRole.fields.contact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.orderRole.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderRole.fields.user_helper') }}</span>
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