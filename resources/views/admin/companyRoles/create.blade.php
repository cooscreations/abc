@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.companyRole.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.company-roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.companyRole.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyRole.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="role_id">{{ trans('cruds.companyRole.fields.role') }}</label>
                <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role_id" id="role_id">
                    @foreach($roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyRole.fields.role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_id">{{ trans('cruds.companyRole.fields.contact') }}</label>
                <select class="form-control select2 {{ $errors->has('contact') ? 'is-invalid' : '' }}" name="contact_id" id="contact_id">
                    @foreach($contacts as $id => $entry)
                        <option value="{{ $id }}" {{ old('contact_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyRole.fields.contact_helper') }}</span>
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