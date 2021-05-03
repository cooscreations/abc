@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.orderItem.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.order-items.update", [$orderItem->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="order_id">{{ trans('cruds.orderItem.fields.order') }}</label>
                            <select class="form-control select2" name="order_id" id="order_id" required>
                                @foreach($orders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $orderItem->order->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{ trans('cruds.orderItem.fields.quantity') }}</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity', $orderItem->quantity) }}" step="1">
                            @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.quantity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_id">{{ trans('cruds.orderItem.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id">
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $orderItem->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_sku_id">{{ trans('cruds.orderItem.fields.product_sku') }}</label>
                            <select class="form-control select2" name="product_sku_id" id="product_sku_id">
                                @foreach($product_skus as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_sku_id') ? old('product_sku_id') : $orderItem->product_sku->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_sku'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_sku') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.product_sku_helper') }}</span>
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