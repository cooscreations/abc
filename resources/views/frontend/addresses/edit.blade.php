@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.address.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.addresses.update", [$address->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.address.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $address->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.address.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $address->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="text" name="add_line_1" id="add_line_1" value="{{ old('add_line_1', $address->add_line_1) }}">
                            @if($errors->has('add_line_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_line_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.add_line_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_line_2">{{ trans('cruds.address.fields.add_line_2') }}</label>
                            <input class="form-control" type="text" name="add_line_2" id="add_line_2" value="{{ old('add_line_2', $address->add_line_2) }}">
                            @if($errors->has('add_line_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_line_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.add_line_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_line_3">{{ trans('cruds.address.fields.add_line_3') }}</label>
                            <input class="form-control" type="text" name="add_line_3" id="add_line_3" value="{{ old('add_line_3', $address->add_line_3) }}">
                            @if($errors->has('add_line_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_line_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.add_line_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city">{{ trans('cruds.address.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', $address->city) }}">
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="province_id">{{ trans('cruds.address.fields.province') }}</label>
                            <select class="form-control select2" name="province_id" id="province_id">
                                @foreach($provinces as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('province_id') ? old('province_id') : $address->province->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="country_id" id="country_id">
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $address->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <div>
                                <input type="hidden" name="is_billing_address" value="0">
                                <input type="checkbox" name="is_billing_address" id="is_billing_address" value="1" {{ $address->is_billing_address || old('is_billing_address', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_billing_address">{{ trans('cruds.address.fields.is_billing_address') }}</label>
                            </div>
                            @if($errors->has('is_billing_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_billing_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.is_billing_address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_shipping_address" value="0">
                                <input type="checkbox" name="is_shipping_address" id="is_shipping_address" value="1" {{ $address->is_shipping_address || old('is_shipping_address', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_shipping_address">{{ trans('cruds.address.fields.is_shipping_address') }}</label>
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
                            <select class="form-control select2" name="nearest_shipping_port_id" id="nearest_shipping_port_id">
                                @foreach($nearest_shipping_ports as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('nearest_shipping_port_id') ? old('nearest_shipping_port_id') : $address->nearest_shipping_port->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection