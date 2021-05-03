@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.expense.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.expenses.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="expense_category_id">{{ trans('cruds.expense.fields.expense_category') }}</label>
                            <select class="form-control select2" name="expense_category_id" id="expense_category_id">
                                @foreach($expense_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('expense_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('expense_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expense_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.expense_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="entry_date">{{ trans('cruds.expense.fields.entry_date') }}</label>
                            <input class="form-control date" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required>
                            @if($errors->has('entry_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entry_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.entry_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.expense.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_id">{{ trans('cruds.expense.fields.bank_account') }}</label>
                            <select class="form-control select2" name="bank_account_id" id="bank_account_id">
                                @foreach($bank_accounts as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bank_account_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_account') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.bank_account_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency_id">{{ trans('cruds.expense.fields.currency') }}</label>
                            <select class="form-control select2" name="currency_id" id="currency_id">
                                @foreach($currencies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="usd_amount">{{ trans('cruds.expense.fields.usd_amount') }}</label>
                            <input class="form-control" type="number" name="usd_amount" id="usd_amount" value="{{ old('usd_amount', '0.00') }}" step="0.01" required>
                            @if($errors->has('usd_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('usd_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.usd_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="exchange_rate_id">{{ trans('cruds.expense.fields.exchange_rate') }}</label>
                            <select class="form-control select2" name="exchange_rate_id" id="exchange_rate_id" required>
                                @foreach($exchange_rates as $id => $entry)
                                    <option value="{{ $id }}" {{ old('exchange_rate_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('exchange_rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('exchange_rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.exchange_rate_helper') }}</span>
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