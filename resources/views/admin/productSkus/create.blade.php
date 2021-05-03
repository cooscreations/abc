@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productSku.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-skus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_sku">{{ trans('cruds.productSku.fields.product_sku') }}</label>
                <input class="form-control {{ $errors->has('product_sku') ? 'is-invalid' : '' }}" type="text" name="product_sku" id="product_sku" value="{{ old('product_sku', '') }}">
                @if($errors->has('product_sku'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_sku') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSku.fields.product_sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.productSku.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSku.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prod_dev_stage_id">{{ trans('cruds.productSku.fields.prod_dev_stage') }}</label>
                <select class="form-control select2 {{ $errors->has('prod_dev_stage') ? 'is-invalid' : '' }}" name="prod_dev_stage_id" id="prod_dev_stage_id">
                    @foreach($prod_dev_stages as $id => $entry)
                        <option value="{{ $id }}" {{ old('prod_dev_stage_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prod_dev_stage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prod_dev_stage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSku.fields.prod_dev_stage_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="size_id">{{ trans('cruds.productSku.fields.size') }}</label>
                <select class="form-control select2 {{ $errors->has('size') ? 'is-invalid' : '' }}" name="size_id" id="size_id" required>
                    @foreach($sizes as $id => $entry)
                        <option value="{{ $id }}" {{ old('size_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSku.fields.size_helper') }}</span>
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