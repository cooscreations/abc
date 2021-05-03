@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.companyRole.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.company-roles.update", [$companyRole->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.companyRole.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $companyRole->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="role_id" id="role_id">
                                @foreach($roles as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('role_id') ? old('role_id') : $companyRole->role->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="contact_id" id="contact_id">
                                @foreach($contacts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('contact_id') ? old('contact_id') : $companyRole->contact->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection