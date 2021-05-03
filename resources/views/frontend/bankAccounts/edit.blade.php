@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bankAccount.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bank-accounts.update", [$bankAccount->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.bankAccount.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $bankAccount->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bank_name">{{ trans('cruds.bankAccount.fields.bank_name') }}</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $bankAccount->bank_name) }}">
                            @if($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.bank_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="beneficiary">{{ trans('cruds.bankAccount.fields.beneficiary') }}</label>
                            <input class="form-control" type="text" name="beneficiary" id="beneficiary" value="{{ old('beneficiary', $bankAccount->beneficiary) }}">
                            @if($errors->has('beneficiary'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('beneficiary') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.beneficiary_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.bankAccount.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $bankAccount->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="address_id" id="address_id">
                                @foreach($addresses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('address_id') ? old('address_id') : $bankAccount->address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="text" name="account_number" id="account_number" value="{{ old('account_number', $bankAccount->account_number) }}" required>
                            @if($errors->has('account_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.account_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="swift_code">{{ trans('cruds.bankAccount.fields.swift_code') }}</label>
                            <input class="form-control" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', $bankAccount->swift_code) }}">
                            @if($errors->has('swift_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('swift_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.swift_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tlx_number">{{ trans('cruds.bankAccount.fields.tlx_number') }}</label>
                            <input class="form-control" type="text" name="tlx_number" id="tlx_number" value="{{ old('tlx_number', $bankAccount->tlx_number) }}">
                            @if($errors->has('tlx_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tlx_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.tlx_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="default_comment_on_tnx">{{ trans('cruds.bankAccount.fields.default_comment_on_tnx') }}</label>
                            <textarea class="form-control" name="default_comment_on_tnx" id="default_comment_on_tnx">{{ old('default_comment_on_tnx', $bankAccount->default_comment_on_tnx) }}</textarea>
                            @if($errors->has('default_comment_on_tnx'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_comment_on_tnx') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.default_comment_on_tnx_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.bankAccount.fields.internal_notes') }}</label>
                            <textarea class="form-control" name="internal_notes" id="internal_notes">{{ old('internal_notes', $bankAccount->internal_notes) }}</textarea>
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

        </div>
    </div>
</div>
@endsection