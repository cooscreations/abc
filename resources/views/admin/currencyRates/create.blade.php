@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.currencyRate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.currency-rates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="usd_value">{{ trans('cruds.currencyRate.fields.usd_value') }}</label>
                <input class="form-control {{ $errors->has('usd_value') ? 'is-invalid' : '' }}" type="number" name="usd_value" id="usd_value" value="{{ old('usd_value', '') }}" step="0.01" required>
                @if($errors->has('usd_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('usd_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.currencyRate.fields.usd_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency_id">{{ trans('cruds.currencyRate.fields.currency') }}</label>
                <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id">
                    @foreach($currencies as $id => $entry)
                        <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('currency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.currencyRate.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_until">{{ trans('cruds.currencyRate.fields.valid_until') }}</label>
                <input class="form-control date {{ $errors->has('valid_until') ? 'is-invalid' : '' }}" type="text" name="valid_until" id="valid_until" value="{{ old('valid_until') }}">
                @if($errors->has('valid_until'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valid_until') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.currencyRate.fields.valid_until_helper') }}</span>
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