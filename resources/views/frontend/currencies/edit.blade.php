@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.currency.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.currencies.update", [$currency->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.currency.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $currency->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="symbol">{{ trans('cruds.currency.fields.symbol') }}</label>
                            <input class="form-control" type="text" name="symbol" id="symbol" value="{{ old('symbol', $currency->symbol) }}">
                            @if($errors->has('symbol'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('symbol') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.symbol_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="alpha_3">{{ trans('cruds.currency.fields.alpha_3') }}</label>
                            <input class="form-control" type="text" name="alpha_3" id="alpha_3" value="{{ old('alpha_3', $currency->alpha_3) }}">
                            @if($errors->has('alpha_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alpha_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.alpha_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="countries">{{ trans('cruds.currency.fields.countries') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="countries[]" id="countries" multiple>
                                @foreach($countries as $id => $countries)
                                    <option value="{{ $id }}" {{ (in_array($id, old('countries', [])) || $currency->countries->contains($id)) ? 'selected' : '' }}>{{ $countries }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('countries'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('countries') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.countries_helper') }}</span>
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