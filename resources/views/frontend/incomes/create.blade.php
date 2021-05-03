@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.income.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.incomes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                            <select class="form-control select2" name="income_category_id" id="income_category_id">
                                @foreach($income_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('income_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('income_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.income_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="entry_date">{{ trans('cruds.income.fields.entry_date') }}</label>
                            <input class="form-control date" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required>
                            @if($errors->has('entry_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entry_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_id">{{ trans('cruds.income.fields.bank_account') }}</label>
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
                            <span class="help-block">{{ trans('cruds.income.fields.bank_account_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="usd_amount">{{ trans('cruds.income.fields.usd_amount') }}</label>
                            <input class="form-control" type="number" name="usd_amount" id="usd_amount" value="{{ old('usd_amount', '') }}" step="0.01">
                            @if($errors->has('usd_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('usd_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.usd_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="exchange_rate_id">{{ trans('cruds.income.fields.exchange_rate') }}</label>
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
                            <span class="help-block">{{ trans('cruds.income.fields.exchange_rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="currency_id">{{ trans('cruds.income.fields.currency') }}</label>
                            <select class="form-control select2" name="currency_id" id="currency_id" required>
                                @foreach($currencies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order_id">{{ trans('cruds.income.fields.order') }}</label>
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
                            <span class="help-block">{{ trans('cruds.income.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="reference">{{ trans('cruds.income.fields.reference') }}</label>
                            <input class="form-control" type="text" name="reference" id="reference" value="{{ old('reference', '') }}">
                            @if($errors->has('reference'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reference') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.reference_helper') }}</span>
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