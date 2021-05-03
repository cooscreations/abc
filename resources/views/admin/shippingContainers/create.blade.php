@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shippingContainer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shipping-containers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="container_number">{{ trans('cruds.shippingContainer.fields.container_number') }}</label>
                <input class="form-control {{ $errors->has('container_number') ? 'is-invalid' : '' }}" type="text" name="container_number" id="container_number" value="{{ old('container_number', '') }}" required>
                @if($errors->has('container_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('container_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.container_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.shippingContainer.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $entry)
                        <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_company_id">{{ trans('cruds.shippingContainer.fields.shipping_company') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_company') ? 'is-invalid' : '' }}" name="shipping_company_id" id="shipping_company_id">
                    @foreach($shipping_companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('shipping_company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.shipping_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="est_loading_date">{{ trans('cruds.shippingContainer.fields.est_loading_date') }}</label>
                <input class="form-control date {{ $errors->has('est_loading_date') ? 'is-invalid' : '' }}" type="text" name="est_loading_date" id="est_loading_date" value="{{ old('est_loading_date') }}">
                @if($errors->has('est_loading_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('est_loading_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.est_loading_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="actual_loading_date">{{ trans('cruds.shippingContainer.fields.actual_loading_date') }}</label>
                <input class="form-control date {{ $errors->has('actual_loading_date') ? 'is-invalid' : '' }}" type="text" name="actual_loading_date" id="actual_loading_date" value="{{ old('actual_loading_date') }}">
                @if($errors->has('actual_loading_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('actual_loading_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.actual_loading_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_date">{{ trans('cruds.shippingContainer.fields.booking_date') }}</label>
                <input class="form-control date {{ $errors->has('booking_date') ? 'is-invalid' : '' }}" type="text" name="booking_date" id="booking_date" value="{{ old('booking_date') }}">
                @if($errors->has('booking_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.booking_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="so_date">{{ trans('cruds.shippingContainer.fields.so_date') }}</label>
                <input class="form-control date {{ $errors->has('so_date') ? 'is-invalid' : '' }}" type="text" name="so_date" id="so_date" value="{{ old('so_date') }}">
                @if($errors->has('so_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('so_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.so_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="si_date">{{ trans('cruds.shippingContainer.fields.si_date') }}</label>
                <input class="form-control date {{ $errors->has('si_date') ? 'is-invalid' : '' }}" type="text" name="si_date" id="si_date" value="{{ old('si_date') }}">
                @if($errors->has('si_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('si_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.si_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estimated_time_of_departure">{{ trans('cruds.shippingContainer.fields.estimated_time_of_departure') }}</label>
                <input class="form-control date {{ $errors->has('estimated_time_of_departure') ? 'is-invalid' : '' }}" type="text" name="estimated_time_of_departure" id="estimated_time_of_departure" value="{{ old('estimated_time_of_departure') }}">
                @if($errors->has('estimated_time_of_departure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estimated_time_of_departure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.estimated_time_of_departure_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="eta">{{ trans('cruds.shippingContainer.fields.eta') }}</label>
                <input class="form-control date {{ $errors->has('eta') ? 'is-invalid' : '' }}" type="text" name="eta" id="eta" value="{{ old('eta') }}">
                @if($errors->has('eta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('eta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.eta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="copy_bl_rec_date">{{ trans('cruds.shippingContainer.fields.copy_bl_rec_date') }}</label>
                <input class="form-control date {{ $errors->has('copy_bl_rec_date') ? 'is-invalid' : '' }}" type="text" name="copy_bl_rec_date" id="copy_bl_rec_date" value="{{ old('copy_bl_rec_date') }}">
                @if($errors->has('copy_bl_rec_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('copy_bl_rec_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.copy_bl_rec_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docs_sent_date">{{ trans('cruds.shippingContainer.fields.docs_sent_date') }}</label>
                <input class="form-control date {{ $errors->has('docs_sent_date') ? 'is-invalid' : '' }}" type="text" name="docs_sent_date" id="docs_sent_date" value="{{ old('docs_sent_date') }}">
                @if($errors->has('docs_sent_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('docs_sent_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.docs_sent_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bl_release_date">{{ trans('cruds.shippingContainer.fields.bl_release_date') }}</label>
                <input class="form-control date {{ $errors->has('bl_release_date') ? 'is-invalid' : '' }}" type="text" name="bl_release_date" id="bl_release_date" value="{{ old('bl_release_date') }}">
                @if($errors->has('bl_release_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bl_release_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shippingContainer.fields.bl_release_date_helper') }}</span>
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