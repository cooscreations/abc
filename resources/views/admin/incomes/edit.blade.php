@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.income.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incomes.update", [$income->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                <select class="form-control select2 {{ $errors->has('income_category') ? 'is-invalid' : '' }}" name="income_category_id" id="income_category_id">
                    @foreach($income_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('income_category_id') ? old('income_category_id') : $income->income_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control date {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date', $income->entry_date) }}" required>
                @if($errors->has('entry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entry_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $income->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $income->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_account_id">{{ trans('cruds.income.fields.bank_account') }}</label>
                <select class="form-control select2 {{ $errors->has('bank_account') ? 'is-invalid' : '' }}" name="bank_account_id" id="bank_account_id">
                    @foreach($bank_accounts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bank_account_id') ? old('bank_account_id') : $income->bank_account->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control {{ $errors->has('usd_amount') ? 'is-invalid' : '' }}" type="number" name="usd_amount" id="usd_amount" value="{{ old('usd_amount', $income->usd_amount) }}" step="0.01">
                @if($errors->has('usd_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('usd_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.usd_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="exchange_rate_id">{{ trans('cruds.income.fields.exchange_rate') }}</label>
                <select class="form-control select2 {{ $errors->has('exchange_rate') ? 'is-invalid' : '' }}" name="exchange_rate_id" id="exchange_rate_id" required>
                    @foreach($exchange_rates as $id => $entry)
                        <option value="{{ $id }}" {{ (old('exchange_rate_id') ? old('exchange_rate_id') : $income->exchange_rate->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id" required>
                    @foreach($currencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('currency_id') ? old('currency_id') : $income->currency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $income->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text" name="reference" id="reference" value="{{ old('reference', $income->reference) }}">
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



@endsection