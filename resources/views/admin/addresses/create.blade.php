@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.address.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.addresses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.address.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.address.fields.company') }}</label>
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
                <span class="help-block">{{ trans('cruds.address.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="add_line_1">{{ trans('cruds.address.fields.add_line_1') }}</label>
                <input class="form-control {{ $errors->has('add_line_1') ? 'is-invalid' : '' }}" type="text" name="add_line_1" id="add_line_1" value="{{ old('add_line_1', '') }}">
                @if($errors->has('add_line_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('add_line_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.add_line_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="add_line_2">{{ trans('cruds.address.fields.add_line_2') }}</label>
                <input class="form-control {{ $errors->has('add_line_2') ? 'is-invalid' : '' }}" type="text" name="add_line_2" id="add_line_2" value="{{ old('add_line_2', '') }}">
                @if($errors->has('add_line_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('add_line_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.add_line_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="add_line_3">{{ trans('cruds.address.fields.add_line_3') }}</label>
                <input class="form-control {{ $errors->has('add_line_3') ? 'is-invalid' : '' }}" type="text" name="add_line_3" id="add_line_3" value="{{ old('add_line_3', '') }}">
                @if($errors->has('add_line_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('add_line_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.add_line_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.address.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province_id">{{ trans('cruds.address.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id">
                    @foreach($provinces as $id => $entry)
                        <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.address.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_billing_address') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_billing_address" value="0">
                    <input class="form-check-input" type="checkbox" name="is_billing_address" id="is_billing_address" value="1" {{ old('is_billing_address', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_billing_address">{{ trans('cruds.address.fields.is_billing_address') }}</label>
                </div>
                @if($errors->has('is_billing_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_billing_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.is_billing_address_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_shipping_address') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_shipping_address" value="0">
                    <input class="form-check-input" type="checkbox" name="is_shipping_address" id="is_shipping_address" value="1" {{ old('is_shipping_address', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_shipping_address">{{ trans('cruds.address.fields.is_shipping_address') }}</label>
                </div>
                @if($errors->has('is_shipping_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_shipping_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.is_shipping_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nearest_shipping_port_id">{{ trans('cruds.address.fields.nearest_shipping_port') }}</label>
                <select class="form-control select2 {{ $errors->has('nearest_shipping_port') ? 'is-invalid' : '' }}" name="nearest_shipping_port_id" id="nearest_shipping_port_id">
                    @foreach($nearest_shipping_ports as $id => $entry)
                        <option value="{{ $id }}" {{ old('nearest_shipping_port_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nearest_shipping_port'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nearest_shipping_port') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.nearest_shipping_port_helper') }}</span>
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