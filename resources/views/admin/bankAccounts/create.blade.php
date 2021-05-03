@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bankAccount.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bank-accounts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bankAccount.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', 'Default Account') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_name">{{ trans('cruds.bankAccount.fields.bank_name') }}</label>
                <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', '') }}">
                @if($errors->has('bank_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.bank_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beneficiary">{{ trans('cruds.bankAccount.fields.beneficiary') }}</label>
                <input class="form-control {{ $errors->has('beneficiary') ? 'is-invalid' : '' }}" type="text" name="beneficiary" id="beneficiary" value="{{ old('beneficiary', '') }}">
                @if($errors->has('beneficiary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beneficiary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.beneficiary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.bankAccount.fields.company') }}</label>
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
                <span class="help-block">{{ trans('cruds.bankAccount.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_id">{{ trans('cruds.bankAccount.fields.address') }}</label>
                <select class="form-control select2 {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id">
                    @foreach($addresses as $id => $entry)
                        <option value="{{ $id }}" {{ old('address_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_number">{{ trans('cruds.bankAccount.fields.account_number') }}</label>
                <input class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" type="text" name="account_number" id="account_number" value="{{ old('account_number', '') }}" required>
                @if($errors->has('account_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.account_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="swift_code">{{ trans('cruds.bankAccount.fields.swift_code') }}</label>
                <input class="form-control {{ $errors->has('swift_code') ? 'is-invalid' : '' }}" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', '') }}">
                @if($errors->has('swift_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('swift_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.swift_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tlx_number">{{ trans('cruds.bankAccount.fields.tlx_number') }}</label>
                <input class="form-control {{ $errors->has('tlx_number') ? 'is-invalid' : '' }}" type="text" name="tlx_number" id="tlx_number" value="{{ old('tlx_number', '') }}">
                @if($errors->has('tlx_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tlx_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.tlx_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_comment_on_tnx">{{ trans('cruds.bankAccount.fields.default_comment_on_tnx') }}</label>
                <textarea class="form-control {{ $errors->has('default_comment_on_tnx') ? 'is-invalid' : '' }}" name="default_comment_on_tnx" id="default_comment_on_tnx">{{ old('default_comment_on_tnx') }}</textarea>
                @if($errors->has('default_comment_on_tnx'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_comment_on_tnx') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.default_comment_on_tnx_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.bankAccount.fields.internal_notes') }}</label>
                <textarea class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" name="internal_notes" id="internal_notes">{{ old('internal_notes') }}</textarea>
                @if($errors->has('internal_notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('internal_notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.internal_notes_helper') }}</span>
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